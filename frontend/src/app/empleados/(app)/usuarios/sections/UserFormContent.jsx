'use client'
import { Input } from '@/components/ui/input'
import { useToast } from '@/components/ui/use-toast'
import { useForm } from 'react-hook-form'
import { useSWRConfig } from 'swr'
import useSWRMutation from 'swr/mutation'
import { zodResolver } from '@hookform/resolvers/zod'
import { storeFetcher, updateFetcher } from '@/lib/utils'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Button } from '@/components/ui/button'
import { z } from 'zod'
import axios from 'axios'

const userSchema = z.object({
  name: z.string().min(1, 'Se requiere nombre'),
  email: z.string().email().min(1, 'Se requiere email'),
  password: z.string().min(1, 'Se requiere contraseña'),
  password_confirmation: z.string().min(1, 'Se requiere repetir contraseña'),
})

const userEditSchema = z.object({
  name: z.string().min(1, 'Se requiere nombre'),
  email: z.string().email().min(1, 'Se requiere email'),
  password: z.string().nullable(),
  password_confirmation: z.string().nullable(),
})

export default function UserFormContent({ onFormSubmit, user, editing }) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(editing ? userEditSchema : userSchema),
    defaultValues: {
      name: user.name ?? '',
      email: user.email ?? '',
      password: user.password ?? '',
      password_confirmation: user.password ?? '',
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/users',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 User modificado con éxito`
            : `😄 User agregado con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/users')
        onFormSubmit()
      },
      onError(err) {
        if (axios.isAxiosError(err)) {
          if (err.response.status === 422) {
            const errors = err.response.data.errors ?? {}
            for (const [key, value] of Object.entries(errors)) {
              form.setError(key, {
                type: 'manual',
                message: value.join(', '),
              })
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
      throwOnError: false,
    },
  )

  function onSubmit(values) {
    const data = {
      ...values,
    }

    if (editing) {
      trigger({ id: user?.id, data })
    } else {
      trigger({ data })
    }
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
        {editing && (
          <p className="col-span-12">
            Escriba contraseña solo si desea cambiarla
          </p>
        )}
        <FormField
          control={form.control}
          name="name"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Nombre y Apellido</FormLabel>
              <FormControl>
                <Input
                  id="name"
                  name="name"
                  placeholder="Escriba nombre y apellido"
                  className="col-span-12"
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="email"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Email</FormLabel>
              <FormControl>
                <Input
                  id="email"
                  name="email"
                  placeholder="Escriba email"
                  className="col-span-12"
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="password"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Contraseña</FormLabel>
              <FormControl>
                <Input
                  id="password"
                  name="password"
                  type="password"
                  placeholder="Escriba password"
                  className="col-span-12"
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="password_confirmation"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Confirme contraseña</FormLabel>
              <FormControl>
                <Input
                  id="password_confirmation"
                  name="password_confirmation"
                  type="password"
                  placeholder="Escriba contraseña nuevamente"
                  className="col-span-12"
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        {form.formState.errors.root && (
          <p className="col-span-12 text-sm text-red-500">
            {form.formState.errors.root.serverError.message}
          </p>
        )}

        <Button type="submit" className="col-span-6">
          {isMutating ? 'Guardando...' : 'Guardar'}
        </Button>
      </form>
    </Form>
  )
}
