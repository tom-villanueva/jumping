'use client'

import { DataTable } from '@/components/client-table/data-table'
import { useDebounce } from '@/hooks/useDebounce'
import { convertToUTC, formatDate } from '@/lib/utils'
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
import { useTraslados } from '@/services/traslados'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

export default function TrasladosTable() {
  const [columnFilters, setColumnFilters] = useState([
    {
      id: 'fecha_desde_after',
      value: [today],
    },
    {
      id: 'fecha_hasta_before',
      value: [today],
    },
  ])
  const debouncedColumnFilters = useDebounce(columnFilters, 1000)
  const [sorting, setSorting] = useState([])
  const [pagination, setPagination] = useState({
    pageIndex: 0, //initial page index
    pageSize: 10, //default page size
  })

  useEffect(() => {
    if (setPagination) {
      setPagination(pagination => ({
        pageIndex: 0,
        pageSize: pagination.pageSize,
      }))
    }
  }, [columnFilters, setPagination])

  const { traslados, isLoading, isError } = useTraslados({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      sort: '-fecha_desde',
      include: 'reserva',
    },
    filters: debouncedColumnFilters,
  })

  const columns = [
    {
      header: 'Nro. reserva',
      accessorKey: 'reserva.id',
      id: 'reserva_id',
      enableColumnFilter: false,
    },
    {
      header: 'Apellido',
      accessorKey: 'reserva.apellido',
    },
    {
      header: 'Nombre',
      accessorKey: 'reserva.nombre',
    },
    {
      header: 'Email',
      accessorKey: 'reserva.email',
    },
    {
      accessorKey: 'fecha_desde',
      id: 'fecha_desde_after',
      header: 'Fecha Inicio',
      accesorFn: row =>
        convertToUTC(row.original.fecha_desde).toLocaleDateString(),
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
      id: 'fecha_hasta_before',
      header: 'Fecha Fin',
      accesorFn: row => convertToUTC(row.fecha_hasta).toLocaleDateString(),
      cell: ({ row }) => {
        return (
          <span>
            {convertToUTC(row.original.fecha_hasta).toLocaleDateString()}
          </span>
        )
      },
    },
  ]

  const table = useReactTable({
    data: traslados?.data || [],
    columns,
    state: {
      pagination,
      sorting,
      columnFilters,
      columnVisibility: {
        articulo_codigo: false,
      },
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

    rowCount: traslados?.total,

    manualPagination: true,
    manualSorting: true,
    manualFiltering: true,
  })

  if (isError) {
    return <p>Error cargando las traslados...</p>
  }

  return (
    <DataTable
      table={table}
      columns={columns}
      isLoading={isLoading}
      filters={[
        {
          type: 'text',
          columnName: 'reserva_id',
          title: 'Nro. reserva',
          options: [],
        },
        {
          type: 'date',
          columnName: 'fecha_desde_after',
          title: 'Fecha Inicio',
          options: [],
        },
        {
          type: 'date',
          columnName: 'fecha_hasta_before',
          title: 'Fecha Fin',
          options: [],
        },
      ]}
    />
  )
}
