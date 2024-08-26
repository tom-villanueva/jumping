'use client'

import { DataTable } from '@/components/client-table/data-table'
import { useDebounce } from '@/hooks/useDebounce'
import { useArticulos } from '@/services/articulos'
import { useTalles } from '@/services/talles'
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

export default function ArticulosPage() {
  const [columnFilters, setColumnFilters] = useState([])
  const debouncedColumnFilters = useDebounce(columnFilters, 1000)
  const [sorting, setSorting] = useState([])
  const [pagination, setPagination] = useState({
    pageIndex: 0, //initial page index
    pageSize: 10, //default page size
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

  const { articulos, isLoading, isError } = useArticulos({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      include: 'tipo_articulo_talle.talle,tipo_articulo_talle.tipo_articulo',
    },
    filters: debouncedColumnFilters,
  })

  const { tipoArticulos, isLoading: isLoadingTipoArticulos } = useTipoArticulos(
    {},
  )

  const { talles, isLoading: isLoadingTalles } = useTalles({})

  const columns = [
    {
      header: 'ID',
      accessorKey: 'id',
      enableColumnFilter: false,
    },
    {
      header: 'Descripcion',
      accessorKey: 'descripcion',
    },
    {
      header: 'Nro Serie',
      accessorKey: 'nro_serie',
    },
    {
      accessorKey: 'tipo_articulo_talle.tipo_articulo.descripcion',
      id: 'tipo_articulo_talle.tipo_articulo.id',
      header: 'Tipo',
    },
    {
      accessorKey: 'tipo_articulo_talle.talle.descripcion',
      id: 'tipo_articulo_talle.talle.id',
      header: 'Talle',
    },
    {
      header: 'Disponible',
      accessorKey: 'disponible',
    },
  ]

  const table = useReactTable({
    data: articulos?.data || [],
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

    rowCount: articulos?.total,

    manualPagination: true,
    manualSorting: true,
    manualFiltering: true,
  })

  if (isError) {
    return <p>Error cargando los artículos...</p>
  }

  return (
    <div className="container mx-auto pt-10">
      <DataTable
        table={table}
        columns={columns}
        isLoading={isLoading}
        filters={[
          {
            type: 'text',
            columnName: 'descripcion',
            title: 'descripcion',
            options: [],
          },
          {
            type: 'text',
            columnName: 'nro_serie',
            title: 'Nro. serie',
            options: [],
          },
          {
            type: 'select',
            columnName: 'tipo_articulo_talle.tipo_articulo.id',
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
            columnName: 'tipo_articulo_talle.talle.id',
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
    </div>
  )
}
