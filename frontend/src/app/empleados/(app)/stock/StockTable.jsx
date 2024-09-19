'use client'

import { DataTable } from '@/components/client-table/data-table'
import { useDebounce } from '@/hooks/useDebounce'
import { useTalles } from '@/services/talles'
import { useTipoArticuloTalles } from '@/services/tipo-articulo-talles'
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

export default function StockTable({
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

  const { tipoArticuloTalles, isLoading, isError } = useTipoArticuloTalles({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      include: 'tipo_articulo,talle',
      sort: 'id',
    },
    filters: debouncedColumnFilters,
  })

  const { tipoArticulos, isLoading: isLoadingTipoArticulos } = useTipoArticulos(
    {},
  )

  const { talles, isLoading: isLoadingTalles } = useTalles({})

  const table = useReactTable({
    data: tipoArticuloTalles?.data || [],
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

    rowCount: tipoArticuloTalles?.total,

    manualPagination: true,
    manualSorting: true,
    manualFiltering: true,
  })

  if (isError) {
    return <p>Error cargando el stock...</p>
  }

  return (
    <DataTable
      table={table}
      columns={columns}
      isLoading={isLoading && isLoadingTalles && isLoadingTipoArticulos}
      filters={[
        {
          type: 'select',
          columnName: 'tipo_articulo.id',
          title: 'Tipos',
          options:
            tipoArticulos?.map(tipo => ({
              label: tipo.descripcion,
              value: tipo.id,
              icon: DotIcon,
            })) ?? [],
        },
        {
          type: 'select',
          columnName: 'talle.id',
          title: 'Talles',
          options:
            talles?.map(talle => ({
              label: talle.descripcion,
              value: talle.id,
              icon: DotIcon,
            })) ?? [],
        },
      ]}
    />
  )
}
