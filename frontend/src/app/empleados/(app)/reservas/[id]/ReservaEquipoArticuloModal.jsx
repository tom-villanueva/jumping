import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import ReservaEquipoArticuloForm from './ReservaEquipoArticuloForm'
import {
  getCoreRowModel,
  getPaginationRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { DataTable } from '@/components/client-table/data-table'
import { Button } from '@/components/ui/button'
import { PlusCircle, Trash } from 'lucide-react'
import { useReservaEquipoArticulos } from '@/services/reserva-equipo-articulos'
import { useMemo, useState } from 'react'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import ReservaEquipoArticuloDevolverForm from './ReservaEquipoArticuloDevolverForm'
import ReservaEquipoArticuloDevolverTodosForm from './ReservaEquipoArticuloDevolverTodosForm'

export default function ReservaEquipoArticuloModal({
  open,
  onOpenChange = () => {},
  tipoArticulos = [],
  reservaEquipo,
}) {
  const [tipoArticuloId, setTipoArticuloId] = useState('')
  const [openFormModal, setOpenFormModal] = useState(false)
  const [openDeleteModal, setOpenDeleteModal] = useState(false)
  const [row, setRow] = useState(null)

  const { reservaEquipoArticulos, isLoading, isValidating, isError } =
    useReservaEquipoArticulos({
      params: {
        include: 'articulo',
      },
      filters: [{ id: 'reserva_equipo_id', value: reservaEquipo?.id ?? '' }],
    })

  /**
   * Esto es un merge entre tipo artículos del equipo
   * con los artículos de la reserva.
   * Cada tipo artículo se corresponde con UN artículo.
   */
  const tableRows = useMemo(() => {
    if (!tipoArticulos || !reservaEquipoArticulos) return []

    return tipoArticulos.map(tipoArticulo => {
      const reservaEquipoArticulo = reservaEquipoArticulos?.find(
        r => r.articulo.tipo_articulo_id === tipoArticulo.id,
      )
      return reservaEquipoArticulo
        ? { ...tipoArticulo, reservaEquipo: { ...reservaEquipoArticulo } }
        : { ...tipoArticulo }
    })
  }, [tipoArticulos, reservaEquipoArticulos])

  const columns = [
    {
      header: 'Descripción',
      accessorKey: 'descripcion',
    },
    {
      header: 'Art desc',
      accessorFn: row =>
        row.reservaEquipo ? row.reservaEquipo.articulo?.descripcion : '-',
    },
    {
      header: 'Código',
      accessorFn: row =>
        row.reservaEquipo ? row.reservaEquipo.articulo?.codigo : '-',
    },
    {
      header: 'Devuelto',
      cell: ({ row }) => (
        <>
          {row.original?.reservaEquipo ? (
            <ReservaEquipoArticuloDevolverForm
              reservaEquipoArticulo={row.original?.reservaEquipo}
            />
          ) : (
            '-'
          )}
        </>
      ),
    },
    {
      header: 'Artículo',
      cell: ({ row }) => (
        <>
          {row.original?.reservaEquipo ? (
            <Button
              variant="destructive"
              onClick={() => {
                setRow(row.original?.reservaEquipo)
                setOpenDeleteModal(true)
              }}>
              <Trash className="h-4 w-4" />
            </Button>
          ) : (
            <Button
              onClick={() => {
                setTipoArticuloId(row.original.pivot.tipo_articulo_id)
                setOpenFormModal(true)
              }}>
              <PlusCircle className="h-4 w-4" />
            </Button>
          )}
        </>
      ),
    },
  ]

  const table = useReactTable({
    data: tableRows || [],
    columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
  })

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="max-h-screen overflow-y-auto sm:max-w-2xl">
        <DialogHeader>
          <DialogTitle>{`Artículos del equipo`}</DialogTitle>
          <DialogDescription>
            Gestión de artículos para el equipo.
          </DialogDescription>
        </DialogHeader>
        <div className="grid grid-cols-12">
          <div className="col-span-12">
            <ReservaEquipoArticuloDevolverTodosForm
              reservaEquipo={reservaEquipo}
            />
          </div>
          <div className="col-span-12">
            <DataTable
              table={table}
              columns={columns}
              isLoading={isLoading || isValidating}
              filters={[]}
            />
          </div>
        </div>
      </DialogContent>
      <DeleteEntityForm
        openDeleteForm={openDeleteModal}
        setOpenDeleteForm={setOpenDeleteModal}
        entity={row}
        apiKey="/api/reserva-equipo-articulos"
        name="articulo reserva"
      />
      <ReservaEquipoArticuloForm
        open={openFormModal}
        onOpenChange={() => setOpenFormModal(!openFormModal)}
        reservaEquipo={reservaEquipo}
        tipoArticuloId={tipoArticuloId}
        onFormSubmit={() => setOpenFormModal(!openFormModal)}
      />
    </Dialog>
  )
}
