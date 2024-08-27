'use client'
import { useState } from 'react'
import {
  flexRender,
  getCoreRowModel,
  useReactTable,
} from '@tanstack/react-table'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { convertToUTC } from '@/lib/utils'
import { Edit, Save, Trash } from 'lucide-react'
import { Button } from '@/components/ui/button'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import EquipoDescuentoUpdateFormModal from './EquipoDescuentoUpdateFormModal'

export default function EquipoDescuentoTable({ descuentos, equipo }) {
  const [selectedDescuento, setSelectedDescuento] = useState(null)
  const [openUpdateFechasModal, setOpenUpdateFechasModal] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)

  const columns = [
    {
      accessorKey: 'id',
      header: 'Id',
      cell: ({ row }) => {
        const pivot = row.original.pivot
        return <span>{pivot?.id}</span>
      },
    },
    {
      accessorKey: 'descripcion',
      header: 'Descripción',
    },
    {
      accessorKey: 'valor',
      header: 'Valor (%)',
      cell: ({ row }) => {
        const valor = row.getValue('valor')

        return <span>{valor}%</span>
      },
    },
    {
      accessorKey: 'fecha_desde',
      header: 'Fecha Inicio',
      cell: ({ row }) => {
        const pivot = row.original.pivot
        return (
          <span>{convertToUTC(pivot?.fecha_desde).toLocaleDateString()}</span>
        )
      },
    },
    {
      accessorKey: 'fecha_hasta',
      header: 'Fecha Fin',
      cell: ({ row }) => {
        const pivot = row.original.pivot
        return (
          <span>{convertToUTC(pivot?.fecha_hasta).toLocaleDateString()}</span>
        )
      },
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const descuento = row.original

        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedDescuento(descuento)
                setOpenUpdateFechasModal(!openUpdateFechasModal)
              }}>
              {descuento?.id === selectedDescuento?.id ? (
                <Save className="h-4 w-4" />
              ) : (
                <Edit className="h-4 w-4" />
              )}
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedDescuento(descuento)
                setOpenDeleteForm(!openDeleteForm)
              }}>
              <Trash className="h-4 w-4" />
            </Button>
          </div>
        )
      },
    },
  ]

  const table = useReactTable({
    data: descuentos,
    columns,
    getCoreRowModel: getCoreRowModel(),
  })

  return (
    <div className="col-span-12">
      <DeleteEntityForm
        openDeleteForm={openDeleteForm}
        setOpenDeleteForm={setOpenDeleteForm}
        entity={{
          ...selectedDescuento,
          id: selectedDescuento?.pivot?.id ?? '',
        }}
        apiKey="/api/equipos/descuentos"
        mutateKey="/api/equipos"
        name="descuento"
      />
      <EquipoDescuentoUpdateFormModal
        openForm={openUpdateFechasModal}
        setOpenForm={setOpenUpdateFechasModal}
        onFormSubmit={() => {
          setSelectedDescuento(null)
          setOpenUpdateFechasModal(!openUpdateFechasModal)
        }}
        descuento={selectedDescuento}
        equipo={equipo}
      />
      <div className="rounded-md border">
        <Table>
          <TableHeader>
            {table.getHeaderGroups().map(headerGroup => (
              <TableRow key={headerGroup.id}>
                {headerGroup.headers.map(header => {
                  return (
                    <TableHead key={header.id}>
                      {header.isPlaceholder
                        ? null
                        : flexRender(
                            header.column.columnDef.header,
                            header.getContext(),
                          )}
                    </TableHead>
                  )
                })}
              </TableRow>
            ))}
          </TableHeader>
          <TableBody>
            {table.getRowModel().rows?.length ? (
              table.getRowModel().rows.map(row => (
                <TableRow
                  key={row.id}
                  data-state={row.getIsSelected() && 'selected'}>
                  {row.getVisibleCells().map(cell => (
                    <TableCell key={cell.id}>
                      {flexRender(
                        cell.column.columnDef.cell,
                        cell.getContext(),
                      )}
                    </TableCell>
                  ))}
                </TableRow>
              ))
            ) : (
              <TableRow>
                <TableCell
                  colSpan={columns.length}
                  className="h-24 text-center">
                  No hay datos.
                </TableCell>
              </TableRow>
            )}
          </TableBody>
        </Table>
      </div>
    </div>
  )
}
