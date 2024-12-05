'use client'

import { Input } from '@/components/ui/input'
import { Separator } from '@/components/ui/separator'
import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import {
  convertToUTC,
  formatDate,
  storeFetcher,
  updateFetcher,
} from '@/lib/utils'
import { Button } from '@/components/ui/button'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import axios from 'axios'
import { Textarea } from '@/components/ui/textarea'
import { reservaSchema, reservaSchemaEdit } from './ReservaSchemas'
import ClientesTable from '../../clientes/ClientesTable'
import { useState } from 'react'
import { Checkbox } from '@/components/ui/checkbox'
import ReservaDetailLabel from '../[id]/ReservaDetailLabel'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { useTipoPersonas } from '@/services/tipo-personas'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

export default function ReservaFormContent({
  onFormSubmit,
  reserva,
  editing,
  apiKey,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()
  const [isClient, setIsClient] = useState(true)
  const [client, setClient] = useState(null)

  const {
    tipoPersonas,
    isLoading: isLoadingTipos,
    isError: isErrorTipos,
  } = useTipoPersonas({
    params: {
      sort: 'id',
      include: 'descuento',
    },
    filters: [],
  })

  const columns = [
    {
      header: 'Apellido',
      accessorKey: 'apellido',
    },
    {
      header: 'Nombre',
      accessorKey: 'nombre',
    },
    {
      header: 'Email',
      accessorKey: 'email',
    },
    {
      header: 'Tier',
      id: 'tipo_persona_id',
      accessorFn: row =>
        `${row.tipo_persona ? row.tipo_persona.descripcion : '-'}`,
    },
  ]

  const form = useForm({
    resolver: zodResolver(editing ? reservaSchemaEdit : reservaSchema),
    defaultValues: {
      cliente_id: null,
      crear_user: false,
      comentario: reserva?.comentario ?? '',
      nombre: reserva?.cliente?.nombre ?? '',
      apellido: reserva?.cliente?.apellido ?? '',
      email: reserva?.cliente?.email ?? '',
      telefono: reserva?.cliente?.telefono ?? '',
      tipo_persona_id: reserva?.cliente?.tipo_persona_id
        ? String(reserva?.cliente?.tipo_persona_id)
        : '1',
      fecha_desde: reserva?.fecha_desde ?? '',
      fecha_hasta: reserva?.fecha_hasta ?? '',
      fecha_prueba: reserva?.fecha_prueba ?? '',
    },
  })

  console.log(form.getValues())

  const { trigger, isMutating } = useSWRMutation(
    '/api/reservas',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Reserva modificada con éxito`
            : `😄 Reserva agregada con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === apiKey)
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
      throwOnError: false,
    },
  )

  function onSubmit(values) {
    const crearUser = values.crear_user && client && client?.user_id === null

    const data = {
      ...values,
      crear_user: crearUser,
    }

    if (editing) {
      trigger({ id: reserva?.id, data })
    } else {
      trigger({ data })
    }
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
        <div className="col-span-12 flex items-center space-x-2">
          <Checkbox
            id="es_cliente"
            checked={isClient}
            onCheckedChange={checked => {
              form.setValue('cliente_id', null)
              form.setValue('apellido', '')
              form.setValue('nombre', '')
              form.setValue('email', '')
              form.setValue('telefono', '')
              setClient(null)
              setIsClient(checked)
            }}
          />
          <label
            htmlFor="es_cliente"
            className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
            ¿Es cliente? Haga Click en uno para seleccionar
          </label>
        </div>

        {isClient ? (
          <div className="col-span-12">
            {form.getValues().cliente_id !== null ? (
              <div>
                <ReservaDetailLabel
                  title={'Nombre'}
                  label={client?.nombre}
                  isValidating={false}
                />
                <ReservaDetailLabel
                  title={'Apellido'}
                  label={client?.apellido}
                  isValidating={false}
                />
                <ReservaDetailLabel
                  title={'Email'}
                  label={client?.email}
                  isValidating={false}
                />
              </div>
            ) : (
              <>
                <ClientesTable
                  columns={columns}
                  pageSize={5}
                  onClick={row => {
                    setClient(row)
                    form.setValue('cliente_id', row.id)
                  }}
                />
                {form.formState.errors.cliente_id && (
                  <p className="col-span-12 text-sm text-red-500">
                    {form.formState.errors.cliente_id.message}
                  </p>
                )}
              </>
            )}
          </div>
        ) : (
          <>
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
              name="email"
              render={({ field }) => (
                <FormItem className="col-span-12 md:col-span-6">
                  <FormLabel>Email</FormLabel>
                  <FormControl>
                    <Input
                      id="email"
                      name="email"
                      type="email"
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
              name="telefono"
              render={({ field }) => (
                <FormItem className="col-span-12 md:col-span-6">
                  <FormLabel>Nro. de Teléfono</FormLabel>
                  <FormControl>
                    <Input
                      id="telefono"
                      name="telefono"
                      placeholder="Escriba Nro. teléfono"
                      className="col-span-12"
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />

            {isLoadingTipos ? (
              <p>Cargando tipos de persona</p>
            ) : (
              <FormField
                control={form.control}
                name="tipo_persona_id"
                render={({ field }) => (
                  <FormItem className="col-span-12">
                    <FormLabel>Tipo</FormLabel>
                    <Select onValueChange={field.onChange} value={field.value}>
                      <FormControl>
                        <SelectTrigger>
                          <SelectValue placeholder="Seleccione un tipo de cliente" />
                        </SelectTrigger>
                      </FormControl>
                      <SelectContent>
                        {tipoPersonas?.map(tipo => (
                          <SelectItem key={tipo?.id} value={String(tipo?.id)}>
                            {`${tipo?.descripcion} (${tipo?.descuento?.descripcion ?? 'Sin'} descuento)`}
                          </SelectItem>
                        ))}
                      </SelectContent>
                    </Select>
                    <FormMessage />
                  </FormItem>
                )}
              />
            )}
          </>
        )}

        {client && client?.user_id !== null ? (
          <p className="col-span-12">Ya tiene usuario generado</p>
        ) : (
          <FormField
            control={form.control}
            name="crear_user"
            render={({ field }) => (
              <FormItem className="col-span-12 flex items-center space-x-2">
                <FormControl>
                  <Checkbox
                    id="crear_user"
                    name="crear_user"
                    checked={field.value}
                    onCheckedChange={field.onChange}
                  />
                </FormControl>
                <FormLabel
                  htmlFor="crear_user"
                  className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                  ¿Generar usuario?
                </FormLabel>
              </FormItem>
            )}
          />
        )}

        {!editing && (
          <>
            <FormField
              control={form.control}
              name="fecha_prueba"
              render={({ field }) => (
                <FormItem className="col-span-12 md:col-span-4">
                  <FormLabel>Fecha Prueba</FormLabel>
                  <FormControl>
                    <Input
                      type="date"
                      name="fecha_prueba"
                      min={editing ? '' : today}
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name="fecha_desde"
              render={({ field }) => (
                <FormItem className="col-span-12 md:col-span-4">
                  <FormLabel>Fecha Inicio</FormLabel>
                  <FormControl>
                    <Input
                      type="date"
                      name="fecha_desde"
                      min={editing ? '' : today}
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
            <FormField
              control={form.control}
              name="fecha_hasta"
              render={({ field }) => (
                <FormItem className="col-span-12 md:col-span-4">
                  <FormLabel>Fecha Fin</FormLabel>
                  <FormControl>
                    <Input
                      type="date"
                      name="fecha_hasta"
                      min={editing ? '' : today}
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
          </>
        )}

        <FormField
          control={form.control}
          name="comentario"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Comentario</FormLabel>
              <FormControl>
                <Textarea
                  id="comentario"
                  name="comentario"
                  placeholder="Escriba comentario"
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

        <Button type="submit" className="col-span-6" disabled={isMutating}>
          {isMutating ? 'Guardando...' : 'Guardar'}
        </Button>
      </form>
    </Form>
  )
}
