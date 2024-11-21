'use client'

import { DataTable } from '@/components/client-table/data-table'
import { useDebounce } from '@/hooks/useDebounce'
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
import { useClientes } from '@/services/clientes'
import { useTipoPersonas } from '@/services/tipo-personas'
import { DotIcon } from 'lucide-react'

export default function ClientesTable({
  onClick = () => {},
  columns,
  pageSize = 10,
}) {
  const [columnFilters, setColumnFilters] = useState([])
  const debouncedColumnFilters = useDebounce(columnFilters, 1000)
  const [sorting, setSorting] = useState([])
  const [pagination, setPagination] = useState({
    pageIndex: 0, //initial page index
    pageSize: pageSize, //default page size
  })

  useEffect(() => {
    if (setPagination) {
      setPagination(pagination => ({
        pageIndex: 0,
        pageSize: pagination.pageSize,
      }))
    }
  }, [columnFilters, setPagination])

  const { clientes, isLoading, isError } = useClientes({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      include: 'tipo_persona',
      sort: 'created_at',
    },
    filters: debouncedColumnFilters,
  })

  const {
    tipoPersonas,
    isLoading: isLoadingTipos,
    isError: isErrorTipos,
  } = useTipoPersonas({
    params: {},
  })

  const table = useReactTable({
    data: clientes?.data || [],
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

    rowCount: clientes?.total,

    manualPagination: true,
    manualSorting: true,
    manualFiltering: true,
  })

  if (isError) {
    return <p>Error cargando las clientes...</p>
  }

  return (
    <div>
      <DataTable
        table={table}
        handleClick={row => onClick(row)}
        columns={columns}
        isLoading={isLoading && isLoadingTipos}
        filters={[
          {
            type: 'text',
            columnName: 'apellido',
            title: 'Apellido',
            options: [],
          },
          {
            type: 'text',
            columnName: 'nombre',
            title: 'Nombre',
            options: [],
          },
          {
            type: 'text',
            columnName: 'email',
            title: 'Email',
            options: [],
          },
          {
            type: 'select',
            columnName: 'tipo_persona_id',
            title: 'Tiers',
            options:
              tipoPersonas?.map(tipo => ({
                label: tipo.descripcion,
                value: tipo.id,
                icon: DotIcon,
              })) ?? [],
          },
        ]}
      />
    </div>
  )
}
