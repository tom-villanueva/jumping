import { DataTable } from '@/components/client-table/data-table'
import { useReservaEquipos } from '@/services/reserva-equipos'
import {
  getCoreRowModel,
  getPaginationRowModel,
  useReactTable,
} from '@tanstack/react-table'
import ReservaEquipoForm from './ReservaEquipoForm'
import { Button } from '@/components/ui/button'
import { useState } from 'react'
import CreateEditEntityModal from '@/components/crud/CreateEditEntityModal'
import ReservaEquipoArticuloModal from './ReservaEquipoArticuloModal'
import { List, Trash } from 'lucide-react'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import { useSWRConfig } from 'swr'
import { RESERVA_PAGADA_ID } from '@/lib/utils'

const RESERVA_EQUIPO_DEFAULT_VALUES = {
  altura: '',
  nombre: '',
  apellido: '',
  peso: '',
  num_calzado: '',
  equipo_id: '',
  reserva_id: '',
}

export default function ReservaEquipoList({ reservaId, estadoId }) {
  const { reservaEquipos, isLoading, isError } = useReservaEquipos({
    params: {
      include: 'equipo,equipo.equipo_tipo_articulo',
    },
    filters: [{ id: 'reserva_id', value: reservaId }],
  })

  const [row, setRow] = useState(null)
  const [openArticuloFormModal, setOpenArticuloFormModal] = useState(false)
  const [openFormModal, setOpenFormModal] = useState(false)
  const [openDeleteModal, setOpenDeleteModal] = useState(false)
  const [editing, setEditing] = useState(false)

  const { mutate } = useSWRConfig()

  const columns = [
    {
      header: 'Equipo',
      accessorKey: 'equipo.descripcion',
    },
    {
      header: 'Apellido',
      accessorKey: 'apellido',
    },
    {
      header: 'Nombre',
      accessorKey: 'nombre',
    },
    {
      header: 'Altura',
      accessorKey: 'altura',
    },
    {
      header: 'Peso',
      accessorKey: 'peso',
    },
    {
      header: 'Num. Calzado',
      accessorKey: 'num_calzado',
    },
    {
      header: 'Acciones',
      cell: ({ row }) => (
        <div className="flex flex-row gap-2">
          <Button
            onClick={() => {
              setRow(row.original)
              setOpenArticuloFormModal(true)
            }}>
            <List className="h-4 w-4" />
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
    data: reservaEquipos || [],
    columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
  })

  return (
    <>
      <div className="flex w-full items-center justify-between gap-4 py-4">
        <h2>Equipos de la reserva</h2>
        <Button
          disabled={estadoId === RESERVA_PAGADA_ID}
          onClick={() => {
            setRow(RESERVA_EQUIPO_DEFAULT_VALUES)
            setEditing(false)
            setOpenFormModal(true)
          }}>
          Agregar equipo a reserva
        </Button>
      </div>
      <CreateEditEntityModal
        open={openFormModal}
        onOpenChange={() => setOpenFormModal(!openFormModal)}
        editing={editing}
        name="reserva equipo">
        <ReservaEquipoForm
          reservaId={reservaId}
          reservaEquipo={row}
          onFormSubmit={() => {
            setOpenFormModal(!openFormModal)
            mutate(
              key =>
                Array.isArray(key) && key[0] === `/api/reservas/${reservaId}`,
            )
          }}
          editing={editing}
        />
      </CreateEditEntityModal>
      <DeleteEntityForm
        openDeleteForm={openDeleteModal}
        setOpenDeleteForm={setOpenDeleteModal}
        entity={row}
        apiKey="/api/reserva-equipos"
        name="equipo de la reserva"
        onFormSubmit={() => {
          mutate(
            key =>
              Array.isArray(key) && key[0] === `/api/reservas/${reservaId}`,
          )
        }}
      />
      <ReservaEquipoArticuloModal
        open={openArticuloFormModal}
        onOpenChange={() => setOpenArticuloFormModal(!openArticuloFormModal)}
        tipoArticulos={row?.equipo?.equipo_tipo_articulo}
        reservaEquipo={row}
        reservaId={reservaId}
      />
      <DataTable
        table={table}
        columns={columns}
        isLoading={isLoading}
        filters={[]}
      />
    </>
  )
}
