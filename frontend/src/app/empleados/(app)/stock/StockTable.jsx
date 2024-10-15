'use client'

import { DataTable } from '@/components/client-table/data-table'
import { useDebounce } from '@/hooks/useDebounce'
import { useInventarios } from '@/services/inventarios'
import { useMarcas } from '@/services/marcas'
import { useModelos } from '@/services/modelos'
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

export default function StockTable({
  columns,
  pageSize = 10,
  columnFilters,
  setColumnFilters,
  debouncedColumnFilters,
}) {
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

  const { inventarios, isLoading, isError } = useInventarios({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      include: 'tipo_articulo,talle,marca,modelo',
    },
    filters: debouncedColumnFilters,
  })

  const { tipoArticulos, isLoading: isLoadingTipoArticulos } = useTipoArticulos(
    {},
  )

  const { talles, isLoading: isLoadingTalles } = useTalles({})
  const { marcas, isLoading: isLoadingMarcas } = useMarcas({})
  const { modelos, isLoading: isLoadingModelos } = useModelos({})

  const table = useReactTable({
    data: inventarios?.data || [],
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

    rowCount: inventarios?.total,

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
      isLoading={
        isLoading &&
        isLoadingTalles &&
        isLoadingTipoArticulos &&
        isLoadingMarcas &&
        isLoadingModelos
      }
      filters={[
        {
          type: 'select',
          columnName: 'tipo_articulo_id',
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
          columnName: 'talle_id',
          title: 'Talles',
          options:
            talles?.map(talle => ({
              label: talle.descripcion,
              value: talle.id,
              icon: DotIcon,
            })) ?? [],
        },
        {
          type: 'select',
          columnName: 'marca_id',
          title: 'Marcas',
          options:
            marcas?.map(marca => ({
              label: marca.descripcion,
              value: marca.id,
              icon: DotIcon,
            })) ?? [],
        },
        {
          type: 'select',
          columnName: 'modelo_id',
          title: 'Modelos',
          options:
            modelos?.map(modelo => ({
              label: modelo.descripcion,
              value: modelo.id,
              icon: DotIcon,
            })) ?? [],
        },
      ]}
    />
  )
}
