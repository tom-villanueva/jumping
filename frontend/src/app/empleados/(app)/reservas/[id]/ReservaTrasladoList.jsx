import { DataTable } from '@/components/client-table/data-table'
import {
  getCoreRowModel,
  getPaginationRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { Button } from '@/components/ui/button'
import { useState } from 'react'
import CreateEditEntityModal from '@/components/crud/CreateEditEntityModal'
import { Edit, Trash } from 'lucide-react'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import { convertToUTC, RESERVA_PAGADA_ID } from '@/lib/utils'
import { useTraslados } from '@/services/traslados'
import ReservaTrasladoForm from './ReservaTrasladoForm'
import { useSWRConfig } from 'swr'

const TRASLADO_DEFAULT_VALUES = {
  direccion: '',
  fecha_desde: '',
  fecha_hasta: '',
}

export default function ReservaTrasladoList({ reserva, reservaId, estadoId }) {
  const { traslados, isLoading, isError } = useTraslados({
    params: {},
    filters: [{ id: 'reserva_id', value: reservaId }],
  })

  const [row, setRow] = useState(null)
  const [openFormModal, setOpenFormModal] = useState(false)
  const [openDeleteModal, setOpenDeleteModal] = useState(false)
  const [editing, setEditing] = useState(false)

  const { mutate } = useSWRConfig()

  const columns = [
    {
      header: 'Dirección',
      accessorKey: 'direccion',
    },
    {
      header: 'Precio',
      accessorKey: 'precio',
      cell: ({ row }) => {
        const precioVigente = row.getValue('precio')
        const formatted = new Intl.NumberFormat('es-AR', {
          style: 'currency',
          currency: 'ARS',
        }).format(precioVigente)

        return <div className="font-medium">{formatted}</div>
      },
    },
    {
      accessorKey: 'fecha_desde',
      header: 'Fecha Inicio',
      cell: ({ row }) => {
        return (
          <span>
            {convertToUTC(row.original.fecha_desde).toLocaleDateString()}
          </span>
        )
      },
    },
    {
      accessorKey: 'fecha_hasta',
      header: 'Fecha Fin',
      cell: ({ row }) => {
        return (
          <span>
            {convertToUTC(row.original.fecha_hasta).toLocaleDateString()}
          </span>
        )
      },
    },
    {
      header: 'Acciones',
      cell: ({ row }) => (
        <div className="flex flex-row gap-2">
          <Button
            disabled={estadoId === RESERVA_PAGADA_ID}
            variant="outline"
            type="button"
            onClick={() => {
              setRow(row.original)
              setEditing(true)
              setOpenFormModal(true)
            }}>
            <Edit className="h-4 w-4" />
          </Button>
          <Button
            disabled={estadoId === RESERVA_PAGADA_ID}
            variant="destructive"
            type="button"
            onClick={() => {
              setRow(row.original)
              setOpenDeleteModal(true)
            }}>
            <Trash className="h-4 w-4" />
          </Button>
        </div>
      ),
    },
  ]

  const table = useReactTable({
    data: traslados || [],
    columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
  })

  return (
    <div className="flex flex-col gap-2 rounded-md border px-2 py-3 text-base">
      <div className="flex w-full items-center justify-between gap-4">
        <Button
          disabled={estadoId === RESERVA_PAGADA_ID}
          onClick={() => {
            setRow(TRASLADO_DEFAULT_VALUES)
            setEditing(false)
            setOpenFormModal(true)
          }}>
          Agregar traslado
        </Button>
      </div>
      <CreateEditEntityModal
        open={openFormModal}
        onOpenChange={() => setOpenFormModal(!openFormModal)}
        editing={editing}
        name="traslado de la reserva">
        <ReservaTrasladoForm
          traslado={row}
          reserva={reserva}
          reservaId={reservaId}
          editing={editing}
          onFormSubmit={() => {
            setOpenFormModal(!openFormModal)
            mutate(
              key =>
                Array.isArray(key) && key[0] === `/api/reservas/${reservaId}`,
            )
          }}
        />
      </CreateEditEntityModal>
      <DeleteEntityForm
        openDeleteForm={openDeleteModal}
        setOpenDeleteForm={setOpenDeleteModal}
        entity={row}
        apiKey="/api/traslados"
        name="traslado de la reserva"
        onFormSubmit={() => {
          mutate(
            key =>
              Array.isArray(key) && key[0] === `/api/reservas/${reservaId}`,
          )
        }}
      />
      <DataTable
        table={table}
        columns={columns}
        isLoading={isLoading}
        filters={[]}
      />
    </div>
  )
}
