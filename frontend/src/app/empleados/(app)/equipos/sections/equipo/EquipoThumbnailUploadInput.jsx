'use client'

import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { useToast } from '@/components/ui/use-toast'
import { storeFetcher } from '@/lib/utils'
import { Form, FormField, FormItem, FormMessage } from '@/components/ui/form'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { useSWRConfig } from 'swr'
import useSWRMutation from 'swr/mutation'
import { z } from 'zod'
import { Button } from '@/components/ui/button'

const ACCEPTED_IMAGE_TYPES = [
  'image/jpeg',
  'image/jpg',
  'image/png',
  'image/webp',
]

const MAX_FILE_SIZE = 1024 * 1024 // 1mb

const uploadEquipoThumbnailSchema = z.object({
  thumb: z
    .any()
    .refine(file => file?.size !== 0, 'Seleccione una imagen.')
    .refine(file => file?.size <= MAX_FILE_SIZE, `Tamaño máximo es 1MB.`)
    .refine(
      file => ACCEPTED_IMAGE_TYPES.includes(file?.type),
      'Se aceptan solo .jpg, .jpeg, .png and .webp',
    ),
})

export default function EquipoThumbnailUploadInput({ equipo }) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(uploadEquipoThumbnailSchema),
    defaultValues: {
      thumb: new File([], '/dummy.png'),
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    `/api/equipos/${equipo?.id}/upload-thumbnail`,
    storeFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 Imagen cargada con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/equipos')
      },
      onError(err) {
        if (axios.isAxiosError(err)) {
          if (err.response.status === 422) {
            const errors = err.response.data.errors ?? {}

            for (const [key, value] of Object.entries(errors)) {
              form.setError(key, { type: 'manual', message: value.join(', ') })
            }
          } else {
            form.setError('root.serverError', {
              type: 'server',
              message: err.response.data.message,
            })
          }
        } else {
          toast({
            title: `🥲 Ocurrió un error ${err.message}`,
            description: 'Intente de nuevo más tarde.',
            variant: 'destructive',
          })
        }
      },
    },
  )

  function onSubmit(values) {
    const payload = new FormData()
    payload.append('thumbnail', values.thumb)

    trigger({ data: payload })
  }

  return (
    <div className="grid grid-cols-12 gap-2">
      {equipo?.thumb_url !== '' ? (
        <img
          className="col-span-6 rounded-md border-2 border-slate-400"
          src={equipo?.thumb_url}
        />
      ) : (
        <img
          className="col-span-4 rounded-md border-2 border-slate-400"
          src="/dummy.png"
        />
      )}
      <Form {...form}>
        <form
          onSubmit={form.handleSubmit(onSubmit)}
          className="col-span-6 flex flex-col gap-2">
          <FormField
            control={form.control}
            name="thumb"
            render={({ field }) => (
              <FormItem className="col-span-5">
                <Label htmlFor="thumb">Thumbnail</Label>
                <Input
                  {...field}
                  id="thumb"
                  name="thumb"
                  type="file"
                  accept={ACCEPTED_IMAGE_TYPES.join(',')}
                  value={field.value?.filename}
                  onChange={event => {
                    field.onChange(event.target.files[0])
                  }}
                />
                <FormMessage />
              </FormItem>
            )}
          />

          {form.formState.errors.root && (
            <p className="col-span-12 text-sm text-red-500">
              {form.formState.errors.root.serverError.message}
            </p>
          )}

          <Button type="submit" className="col-span-12 sm:col-span-2">
            {isMutating ? 'Guardando...' : 'Guardar'}
          </Button>
        </form>
      </Form>
    </div>
  )
}
