'use client'

import { DataTable } from '@/components/client-table/data-table'
import { useDebounce } from '@/hooks/useDebounce'
import { useMetodoPagos } from '@/services/metodo-pagos'
import { useMonedas } from '@/services/monedas'
import { usePagos } from '@/services/pagos'
import { useTipoArticulos } from '@/services/tipo-articulos'
import {
  getCoreRowModel,
  getFacetedRowModel,
  getFacetedUniqueValues,
  getFilteredRowModel,
  getPaginationRowModel,
  getSortedRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { DotIcon } from 'lucide-react'
import { useEffect, useState } from 'react'

export default function PagosTable({
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

  const { pagos, isLoading, isError, isValidating } = usePagos({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      sort: '-id',
      include: 'metodo_pago,moneda,reserva,reserva.cliente',
    },
    filters: debouncedColumnFilters,
  })

  const {
    metodos,
    isLoading: isLoadingMetodos,
    isValidating: isValidatingMetodos,
  } = useMetodoPagos({
    params: {},
    filters: [],
  })

  const {
    monedas,
    isLoading: isLoadingMonedas,
    isValidating: isValidatingMonedas,
  } = useMonedas({
    params: {},
    filters: [],
  })

  const table = useReactTable({
    data: pagos?.data || [],
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

    rowCount: pagos?.total,

    manualPagination: true,
    manualSorting: true,
    manualFiltering: true,
  })

  if (isError) {
    return <p>Error cargando los pagos...</p>
  }

  return (
    <DataTable
      table={table}
      columns={columns}
      isLoading={
        isLoading ||
        isValidating ||
        isLoadingMetodos ||
        isValidatingMetodos ||
        isLoadingMonedas ||
        isValidatingMonedas
      }
      filters={[
        {
          type: 'text',
          columnName: 'reserva_id',
          title: 'Nro. reserva',
          options: [],
        },
        {
          type: 'select',
          columnName: 'metodo_pago_id',
          title: 'Métodos',
          options:
            metodos?.map(metodo => ({
              label: metodo.descripcion,
              value: metodo.id,
              icon: DotIcon,
            })) ?? [],
        },
        {
          type: 'select',
          columnName: 'moneda_id',
          title: 'Monedas',
          options:
            monedas?.map(moneda => ({
              label: moneda.descripcion,
              value: moneda.id,
              icon: DotIcon,
            })) ?? [],
        },
      ]}
    />
  )
}
