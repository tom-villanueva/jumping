'use client'

import { DataTable } from '@/components/client-table/data-table'
import { useDebounce } from '@/hooks/useDebounce'
import { convertToUTC } from '@/lib/utils'
import {
  getCoreRowModel,
  getFacetedRowModel,
  getFacetedUniqueValues,
  getFilteredRowModel,
  getPaginationRowModel,
  getSortedRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { useEffect, useState } from 'react'
import { Button } from '@/components/ui/button'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import { useVouchers } from '@/services/vouchers'
import { TicketCheckIcon, Trash } from 'lucide-react'
import CrearReservaDesdeVoucherDialog from './CrearReservaDesdeVoucherDialog'

export default function VouchersContainer() {
  const [columnFilters, setColumnFilters] = useState([])
  const debouncedColumnFilters = useDebounce(columnFilters, 1000)
  const [sorting, setSorting] = useState([])
  const [pagination, setPagination] = useState({
    pageIndex: 0, //initial page index
    pageSize: 10, //default page size
  })

  const [row, setRow] = useState(null)
  const [openDeleteModal, setOpenDeleteModal] = useState(false)
  const [openCrearReserva, setOpenCrearReserva] = useState(false)

  useEffect(() => {
    if (setPagination) {
      setPagination(pagination => ({
        pageIndex: 0,
        pageSize: pagination.pageSize,
      }))
    }
  }, [columnFilters, setPagination])

  const { vouchers, isLoading, isError } = useVouchers({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      sort: '-fecha_expiracion',
      include: 'cliente,equipo_voucher.equipo',
    },
    filters: debouncedColumnFilters,
  })

  const columns = [
    {
      header: 'Nro',
      accessorKey: 'id',
      enableColumnFilter: false,
    },
    {
      header: 'Apellido',
      accessorKey: 'cliente.apellido',
      id: 'cliente.apellido',
    },
    {
      header: 'Nombre',
      accessorKey: 'cliente.nombre',
      id: 'cliente.nombre',
    },
    {
      header: 'Email',
      accessorKey: 'cliente.email',
      id: 'cliente.email',
    },
    {
      header: 'Usado',
      accessorKey: 'reserva_id',
      cell: ({ row }) => {
        return (
          <span>
            {row.original.reserva_id
              ? `Utilizado para reserva ${row.original.reserva_id}`
              : 'No utilizado.'}
          </span>
        )
      },
    },
    {
      accessorKey: 'fecha_expiracion',
      id: 'fecha_expiracion_after',
      header: 'Fecha Expiración',
      accesorFn: row =>
        convertToUTC(row.original.fecha_expiracion).toLocaleDateString(),
      cell: ({ row }) => {
        const expirationDate = convertToUTC(row.original.fecha_expiracion)
        const today = convertToUTC(new Date())

        // Compare the dates
        const isExpiredOrToday = expirationDate <= today

        return (
          <span className={isExpiredOrToday ? 'text-red-500' : ''}>
            {expirationDate.toLocaleDateString()}
          </span>
        )
      },
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const voucher = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              disabled={voucher?.reserva_id}
              variant="secondary"
              type="button"
              onClick={() => {
                setRow(voucher)
                setOpenCrearReserva(true)
              }}>
              <TicketCheckIcon className="h-4 w-4" />
            </Button>

            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setRow(voucher)
                setOpenDeleteModal(true)
              }}>
              <Trash className="h-4 w-4" />
            </Button>
          </div>
        )
      },
    },
  ]

  const table = useReactTable({
    data: vouchers?.data || [],
    columns,
    state: {
      pagination,
      sorting,
      columnFilters,
      // columnVisibility: {
      //   articulo_codigo: false,
      // },
    },

    onPaginationChange: setPagination,
    onSortingChange: setSorting,
    onColumnFiltersChange: setColumnFilters,

    getCoreRowModel: getCoreRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFacetedRowModel: getFacetedRowModel(),
    getFacetedUniqueValues: getFacetedUniqueValues(),

    rowCount: vouchers?.total,

    manualPagination: true,
    manualSorting: true,
    manualFiltering: true,
  })

  if (isError) {
    return <p>Error cargando los vouchers...</p>
  }

  return (
    <>
      <DeleteEntityForm
        openDeleteForm={openDeleteModal}
        setOpenDeleteForm={setOpenDeleteModal}
        entity={row}
        apiKey="/api/vouchers"
        name="voucher"
      />
      <CrearReservaDesdeVoucherDialog
        openForm={openCrearReserva}
        setOpenForm={setOpenCrearReserva}
        voucher={row}
      />
      <DataTable
        table={table}
        columns={columns}
        isLoading={isLoading}
        filters={[
          {
            type: 'text',
            columnName: 'id',
            title: 'Número',
            options: [],
          },
          {
            type: 'text',
            columnName: 'cliente.apellido',
            title: 'Apellido',
            options: [],
          },
          {
            type: 'text',
            columnName: 'cliente.email',
            title: 'Email',
            options: [],
          },
          {
            type: 'date',
            columnName: 'fecha_expiracion_after',
            title: 'Fecha Expiracion',
            options: [],
          },
        ]}
      />
    </>
  )
}
