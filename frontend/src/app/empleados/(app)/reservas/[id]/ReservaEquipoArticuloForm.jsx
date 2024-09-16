import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import { Form } from '@/components/ui/form'
import ArticulosTable from '../../articulos/ArticulosTable'
import { Button } from '@/components/ui/button'
import { PlusCircle } from 'lucide-react'
import { useForm } from 'react-hook-form'
import { storeFetcher } from '@/lib/utils'
import useSWRMutation from 'swr/mutation'
import { useToast } from '@/components/ui/use-toast'
import { useSWRConfig } from 'swr'
import { z } from 'zod'
import { zodResolver } from '@hookform/resolvers/zod'
import axios from 'axios'

const reservaEquipoArticuloSchema = z.object({
  reserva_equipo_id: z.string().min(1, 'Se requiere reserva equipo id'),
  devuelto: z.boolean(),
})

export default function ReservaEquipoArticuloForm({
  reservaEquipo,
  tipoArticuloId = '',
  open,
  onOpenChange = () => {},
  onFormSubmit,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(reservaEquipoArticuloSchema),
    defaultValues: {
      reserva_equipo_id: String(reservaEquipo?.id) ?? '',
      devuelto: false,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/reserva-equipo-articulos',
    storeFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 Artículo agregado a reserva con éxito`,
        })
        form.reset()
        mutate(
          key =>
            Array.isArray(key) && key[0] === '/api/reserva-equipo-articulos',
        )
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

  function onSubmit(values, articulo) {
    const data = {
      ...values,
      reserva_equipo_id: reservaEquipo?.id,
      articulo_id: articulo.id,
    }

    trigger({ data })
  }

  const columns = [
    {
      header: 'Descripcion',
      accessorKey: 'descripcion',
    },
    {
      header: 'Nro Serie',
      accessorKey: 'nro_serie',
    },
    {
      header: 'Código',
      accessorKey: 'codigo',
    },
    {
      accessorKey: 'tipo_articulo_talle.tipo_articulo.descripcion',
      id: 'tipo_articulo_talle.tipo_articulo.id',
      header: 'Tipo',
    },
    {
      accessorKey: 'tipo_articulo_talle.talle.descripcion',
      id: 'tipo_articulo_talle.talle.id',
      header: 'Talle',
    },
    {
      id: 'acciones',
      cell: ({ row }) => (
        <Form {...form}>
          <form
            onSubmit={form.handleSubmit(data => onSubmit(data, row.original))}>
            <Button>
              <PlusCircle className="h-4 w-4" />
            </Button>
          </form>
        </Form>
      ),
    },
  ]

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="max-h-screen overflow-y-auto sm:max-w-2xl md:max-w-3xl lg:max-w-4xl">
        <DialogHeader>
          <DialogTitle>{`Agregar artículo`}</DialogTitle>
          <DialogDescription>
            Apretar el botón + para agregar.
          </DialogDescription>
        </DialogHeader>
        <div>
          {form.formState.errors.root && (
            <p className="col-span-12 text-sm text-red-500">
              {form.formState.errors.root.serverError.message}
            </p>
          )}
          <ArticulosTable
            columns={columns}
            pageSize={5}
            defaultFilters={[
              {
                id: 'tipo_articulo_talle.tipo_articulo.id',
                value: [tipoArticuloId],
              },
              { id: 'disponible', value: [true] },
            ]}
          />
        </div>
      </DialogContent>
    </Dialog>
  )
}
