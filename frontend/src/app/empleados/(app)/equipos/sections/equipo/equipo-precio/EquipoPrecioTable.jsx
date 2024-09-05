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
import DeleteEntityForm from '../../../../../../../components/crud/DeleteEntityForm'
import EquipoPrecioUpdateFormModal from './EquipoPrecioUpdateFormModal'

export default function EquipoPrecioTable({ precios, equipo }) {
  const [selectedPrecio, setSelectedPrecio] = useState(null)
  const [openUpdateModal, setOpenUpdateModal] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)

  const columns = [
    {
      accessorKey: 'id',
      header: 'Id',
    },
    {
      accessorKey: 'precio',
      header: 'Precio',
    },
    {
      accessorKey: 'fecha_desde',
      header: 'Fecha Inicio',
      cell: ({ row }) => {
        const precio = row.original
        return (
          <span>{convertToUTC(precio?.fecha_desde).toLocaleDateString()}</span>
        )
      },
    },
    {
      accessorKey: 'fecha_hasta',
      header: 'Fecha Fin',
      cell: ({ row }) => {
        const precio = row.original
        return (
          <span>
            {precio?.fecha_hasta &&
              convertToUTC(precio?.fecha_hasta).toLocaleDateString()}
          </span>
        )
      },
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const precio = row.original

        return (
          <div className="flex flex-row gap-2">
            {/* <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedPrecio(precio)
                setOpenUpdateModal(!openUpdateModal)
              }}>
              <Edit className="h-4 w-4" />
            </Button> */}
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedPrecio(precio)
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
    data: precios,
    columns,
    getCoreRowModel: getCoreRowModel(),
  })

  return (
    <div className="col-span-12">
      <DeleteEntityForm
        openDeleteForm={openDeleteForm}
        setOpenDeleteForm={setOpenDeleteForm}
        entity={selectedPrecio}
        apiKey="/api/equipo-precios"
        mutateKey="/api/equipos"
        name="precio"
      />
      {/* <EquipoPrecioUpdateFormModal
        openForm={openUpdateModal}
        setOpenForm={setOpenUpdateModal}
        onFormSubmit={() => {
          setSelectedPrecio(null)
          setOpenUpdateModal(!openUpdateModal)
        }}
        precio={selectedPrecio}
        equipo={equipo}
      /> */}
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
