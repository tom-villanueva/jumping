'use client'
import { useContext, useState } from 'react'
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
import { Edit, Save, Trash } from 'lucide-react'
import { Button } from '@/components/ui/button'
import SelectManyEntitiesContext from '../SelectManyEntitiesContext'
import TipoArticuloTalleForm from './TipoArticuloTalleForm'

export default function TipoArticuloTalleTable() {
  const { selected, updateEntity, deleteEntity } = useContext(
    SelectManyEntitiesContext,
  )
  const [isEditing, setIsEditing] = useState(false)
  const [selectedTalleId, setSelectedTalleId] = useState(null)

  const columns = [
    {
      accessorKey: 'id',
      header: 'Id',
    },
    {
      accessorKey: 'descripcion',
      header: 'Descripción',
    },
    {
      accessorKey: 'stock',
      header: 'Stock Total',
      cell: ({ row }) => {
        const talle = row.original
        const talleId = row.getValue('id')

        if (isEditing && talleId === selectedTalleId) {
          return (
            <input
              autoFocus
              className="max-w-[64px] text-black"
              id="stock"
              name="stock"
              type="number"
              placeholder="stock..."
              defaultValue={talle.stock}
              min="0"
              onChange={e => {
                if (Number(e.target.value) < 0) return
                updateEntity({ ...talle, stock: Number(e.target.value) })
              }}
              onKeyDown={e => {
                e.stopPropagation()
                if (e.key === 'Enter' || e.key === 'Escape') {
                  setIsEditing(!isEditing)
                  setSelectedTalleId(null)
                }
              }}
            />
          )
        } else {
          return <span>{talle.stock}</span>
        }
      },
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const talleId = row.getValue('id')

        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedTalleId(isEditing ? null : talleId)
                setIsEditing(!isEditing)
              }}>
              {isEditing && talleId === selectedTalleId ? (
                <Save className="h-4 w-4" />
              ) : (
                <Edit className="h-4 w-4" />
              )}
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => deleteEntity(talleId)}>
              <Trash className="h-4 w-4" />
            </Button>
          </div>
        )
      },
    },
  ]

  const table = useReactTable({
    data: selected,
    columns,
    getCoreRowModel: getCoreRowModel(),
  })

  return (
    <div className="col-span-12">
      <TipoArticuloTalleForm />
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
