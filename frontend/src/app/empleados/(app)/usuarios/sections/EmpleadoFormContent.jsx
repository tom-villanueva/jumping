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
import { Checkbox } from '@/components/ui/checkbox'

const empleadoSchema = z.object({
  name: z.string().min(1, 'Se requiere nombre'),
  email: z.string().email().min(1, 'Se requiere email'),
  password: z.string().min(1, 'Se requiere contraseña'),
  password_confirmation: z.string().min(1, 'Se requiere repetir contraseña'),
  isAdmin: z.boolean(),
})

const empleadoEditSchema = z.object({
  name: z.string().min(1, 'Se requiere nombre'),
  email: z.string().email().min(1, 'Se requiere email'),
  password: z.string().nullable(),
  password_confirmation: z.string().nullable(),
  isAdmin: z.boolean(),
})

export default function EmpleadoFormContent({
  onFormSubmit,
  empleado,
  editing,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(editing ? empleadoEditSchema : empleadoSchema),
    defaultValues: {
      name: empleado.name ?? '',
      email: empleado.email ?? '',
      password: empleado.password ?? '',
      password_confirmation: empleado.password ?? '',
      isAdmin: empleado.isAdmin ?? false,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/empleados',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Empleado modificada con éxito`
            : `😄 Empleado agregada con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/empleados')
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
      trigger({ id: empleado?.id, data })
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

        <FormField
          control={form.control}
          name="isAdmin"
          render={({ field }) => (
            <FormItem className="col-span-12 flex items-center space-x-2">
              <FormControl>
                <Checkbox
                  id="isAdmin"
                  name="isAdmin"
                  checked={field.value}
                  onCheckedChange={field.onChange}
                />
              </FormControl>
              <FormLabel className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                Es administrador
              </FormLabel>
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
