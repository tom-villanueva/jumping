'use client'
import React from 'react'
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import {
  ColumnDef,
  flexRender,
  getCoreRowModel,
  useReactTable,
} from '@tanstack/react-table'
import Button from '@/components/Button'
import { Modal } from '@/app/empleados/(app)/dashboard/sections/dataTable/Modal'

export const DataTable = () => {
  const data = [
    {
      id: 1,
      estado: 'pendiente',
      metodo: 'tarjeta',
      valor: 50.0,
      nombre: 'Juan Perez',
      fecha: '2023-05-01',
      hora: '10:00 AM',
      banco: 'MercadoPago',
    },
    {
      id: 2,
      estado: 'pagado',
      metodo: 'transferencia',
      valor: 100.0,
      nombre: 'Maria Gomez',
      fecha: '2023-05-02',
      hora: '11:00 AM',
      banco: 'Banco Santander',
    },
    {
      id: 3,
      estado: 'pendiente',
      metodo: 'efectivo',
      valor: 75.0,
      nombre: 'Pedro Rodriguez',
      fecha: '2023-05-03',
      hora: '12:00 PM',
      banco: 'MercadoPago',
    },
    {
      id: 4,
      estado: 'pagado',
      metodo: 'cheque',
      valor: 120.0,
      nombre: 'Ana Lopez',
      fecha: '2023-05-04',
      hora: '1:00 PM',
      banco: 'MercadoPago',
    },
    {
      id: 5,
      estado: 'pendiente',
      metodo: 'tarjeta',
      valor: 90.0,
      nombre: 'Luis Sanchez',
      fecha: '2023-05-05',
      hora: '2:00 PM',
      banco: 'MercadoPago',
    },
    {
      id: 6,
      estado: 'pendiente',
      metodo: 'transferencia',
      valor: 60.0,
      nombre: 'Marta Ramirez',
      fecha: '2023-05-06',
      hora: '3:00 PM',
      banco: 'Banco Nacion',
    },
    {
      id: 7,
      estado: 'pagado',
      metodo: 'efectivo',
      valor: 80.0,
      nombre: 'Jorge Gomez',
      fecha: '2023-05-07',
      hora: '4:00 PM',
      banco: 'Banco Frances',
    },
    {
      id: 8,
      estado: 'error',
      metodo: 'cheque',
      valor: 200.0,
      nombre: 'Sara Martinez',
      fecha: '2023-05-08',
      hora: '5:00 PM',
      banco: 'Banco Macro',
    },
    {
      id: 9,
      estado: 'pendiente',
      metodo: 'tarjeta',
      valor: 150.0,
      nombre: 'Jorge Martinez',
      fecha: '2023-05-09',
      hora: '6:00 PM',
      banco: 'Banco Frances',
    },
    {
      id: 10,
      estado: 'pagado',
      metodo: 'transferencia',
      valor: 175.0,
      nombre: 'Sara Rodriguez',
      fecha: '2023-05-10',
      hora: '7:00 PM',
      banco: 'Banco Nacion',
    },
  ]

  const columns = [
    {
      accessorKey: 'id',
      header: 'Id',
      // cell: ({ row }) => {
      //   const tipoId = row.getValue('id')
      //   return <span className="text-white">{tipoId}</span>
      // },
    },
    {
      accessorKey: 'estado',
      header: 'Estado',
      cell: ({ row }) => {
        const tipoEstado = row.getValue('estado')
        return (
          <span
            className={
              tipoEstado === 'pendiente'
                ? 'uppercase text-yellow-400'
                : tipoEstado === 'pagado'
                  ? 'font-bold uppercase text-green-600'
                  : 'font-bold uppercase text-red-600'
            }>
            {tipoEstado}
          </span>
        )
      },
    },
    {
      accessorKey: 'metodo',
      header: 'Metodo',
      // cell: ({ row }) => {
      //   const tipoMetodo = row.getValue('metodo')
      //   return <span className="text-white">{tipoMetodo}</span>
      // },
    },
    {
      accessorKey: 'valor',
      header: 'Valor',
      // cell: ({ row }) => {
      //   const tipoValor = row.getValue('valor')
      //   return <span className="text-white">{tipoValor}</span>
      // },
    },
    {
      header: 'Acciones',
      cell: ({ row }) => {
        const payment = row.original

        return <Modal payment={payment}></Modal>
      },
    },
  ]

  const table = useReactTable({
    data: data,
    columns,
    getCoreRowModel: getCoreRowModel(),
  })

  return (
    <div className="rounded-md border">
      <Table>
        <TableCaption className="my-5">
          Estas son las últimas 10 compras-
        </TableCaption>
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
                    {flexRender(cell.column.columnDef.cell, cell.getContext())}
                  </TableCell>
                ))}
              </TableRow>
            ))
          ) : (
            <TableRow>
              <TableCell colSpan={columns.length} className="h-24 text-center">
                No hay datos.
              </TableCell>
            </TableRow>
          )}
        </TableBody>
      </Table>
    </div>
  )
}
