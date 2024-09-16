import { zodResolver } from '@hookform/resolvers/zod'
import { useForm } from 'react-hook-form'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { z } from 'zod'
import { useToast } from '@/components/ui/use-toast'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { useEquipos } from '@/services/equipos'
import { storeFetcher, updateFetcher } from '@/lib/utils'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { Separator } from '@/components/ui/separator'

const reservaEquipoSchema = z.object({
  altura: z.string().nullable(),
  nombre: z.string().nullable(),
  apellido: z.string().nullable(),
  peso: z.string().nullable(),
  num_calzado: z.string().nullable(),
  equipo_id: z.string().min(1, 'Se requiere equipo'),
  reserva_id: z.string().min(1, 'Se requiere reserva'),
})

export default function ReservaEquipoForm({
  reservaId,
  reservaEquipo,
  onFormSubmit,
  editing,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()
  const { equipos, isLoading } = useEquipos({})

  const form = useForm({
    resolver: zodResolver(reservaEquipoSchema),
    defaultValues: {
      altura: reservaEquipo?.altura ?? '',
      nombre: reservaEquipo?.nombre ?? '',
      apellido: reservaEquipo?.apellido ?? '',
      peso: reservaEquipo?.peso ?? '',
      num_calzado: reservaEquipo?.num_calzado ?? '',
      equipo_id: reservaEquipo?.equipo_id ?? '',
      reserva_id: reservaId,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/reserva-equipos',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Equipo de reserva modificado con éxito`
            : `😄 Equipo agregado a reserva con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/reserva-equipos')
        onFormSubmit()
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
    const data = {
      ...values,
    }

    if (editing) {
      trigger({ id: reservaEquipo?.id, data })
    } else {
      trigger({ data })
    }
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
        {isLoading ? (
          <p>Cargando equipos</p>
        ) : (
          <FormField
            control={form.control}
            name="equipo_id"
            render={({ field }) => (
              <FormItem className="col-span-12">
                <FormLabel>Equipo</FormLabel>
                <Select onValueChange={field.onChange} value={field.value}>
                  <FormControl>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccione un equipo" />
                    </SelectTrigger>
                  </FormControl>
                  <SelectContent>
                    {equipos?.map(equipo => (
                      <SelectItem key={equipo?.id} value={String(equipo?.id)}>
                        {equipo?.descripcion}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                <FormMessage />
              </FormItem>
            )}
          />
        )}

        <FormField
          control={form.control}
          name="apellido"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Apellido</FormLabel>
              <FormControl>
                <Input
                  id="apellido"
                  name="apellido"
                  placeholder="Escriba apellido"
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
          name="nombre"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Nombre</FormLabel>
              <FormControl>
                <Input
                  id="nombre"
                  name="nombre"
                  placeholder="Escriba nombre"
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
          name="altura"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Altura</FormLabel>
              <FormControl>
                <Input
                  id="altura"
                  name="altura"
                  placeholder="Escriba altura"
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
          name="peso"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Peso</FormLabel>
              <FormControl>
                <Input
                  id="peso"
                  name="peso"
                  placeholder="Escriba peso"
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
          name="num_calzado"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Nro. de calzado</FormLabel>
              <FormControl>
                <Input
                  id="num_calzado"
                  name="num_calzado"
                  placeholder="Escriba Nro. calzado"
                  className="col-span-12"
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <Separator className="col-span-12" />

        {form.formState.errors.root && (
          <p className="col-span-12 text-sm text-red-500">
            {form.formState.errors.root.serverError.message}
          </p>
        )}

        <Button type="submit" className="col-span-6">
          {isMutating ? 'Agregando...' : 'Agregar'}
        </Button>
      </form>
    </Form>
  )
}
