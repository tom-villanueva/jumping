'use client'

import { DataTable } from '@/components/client-table/data-table'
import { useDebounce } from '@/hooks/useDebounce'
import { useMetodoPagos } from '@/services/metodo-pagos'
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

export default function MetodoPagosTable({
  columns,
  defaultFilters = [],
  pageSize = 10,
}) {
  const [columnFilters, setColumnFilters] = useState(defaultFilters)
  const debouncedColumnFilters = useDebounce(columnFilters, 1000)
  const [sorting, setSorting] = useState([])
  const [pagination, setPagination] = useState({
    pageIndex: 0, //initial page index
    pageSize: pageSize, //default page size
  })

  // to reset page index to first page
  useEffect(() => {
    if (setPagination) {
      setPagination(pagination => ({
        pageIndex: 0,
        pageSize: pagination.pageSize,
      }))
    }
  }, [columnFilters, setPagination])

  const { metodos, isLoading, isError, isValidating } = useMetodoPagos({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      sort: 'id',
      include: 'descuento',
    },
    filters: debouncedColumnFilters,
  })

  const table = useReactTable({
    data: metodos?.data || [],
    columns,
    state: {
      pagination,
      sorting,
      columnFilters,
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

    rowCount: metodos?.total,

    manualPagination: true,
    manualSorting: true,
    manualFiltering: true,
  })

  if (isError) {
    return <p>Error cargando los métodos...</p>
  }

  return (
    <DataTable
      table={table}
      columns={columns}
      isLoading={isLoading || isValidating}
      filters={[
        {
          type: 'text',
          columnName: 'descripcion',
          title: 'Descripción',
          options: [],
        },
      ]}
    />
  )
}
