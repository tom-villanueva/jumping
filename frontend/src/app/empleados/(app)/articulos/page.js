'use client'

import { DataTable } from '@/components/client-table/data-table'
import { DataTableRowActions } from '@/components/client-table/data-table-row-actions'
import CreateEditEntityModal from '@/components/crud/CreateEditEntityModal'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
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
import ArticuloFormContent from './ArticuloFormContent'
import { Button } from '@/components/ui/button'

const ARTICULO_DEFAULT_VALUES = {
  descripcion: '',
  codigo: '',
  observacion: '',
  tipo_articulo_id: '',
  talle_id: '',
  nro_serie: '',
  disponible: true,
}

export default function ArticulosPage() {
  const [columnFilters, setColumnFilters] = useState([])
  const debouncedColumnFilters = useDebounce(columnFilters, 1000)
  const [sorting, setSorting] = useState([])
  const [pagination, setPagination] = useState({
    pageIndex: 0, //initial page index
    pageSize: 10, //default page size
  })

  const [row, setRow] = useState(null)
  const [openDeleteModal, setOpenDeleteModal] = useState(false)
  const [openFormModal, setOpenFormModal] = useState(false)
  const [editing, setEditing] = useState(false)

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
      sort: '-id',
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
      header: 'Código',
      accessorKey: 'codigo',
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
      cell: ({ row }) => {
        const disponible = row.getValue('disponible')

        return <span>{disponible ? 'Sí' : 'No'}</span>
      },
    },
    {
      id: 'acciones',
      cell: ({ row }) => (
        <DataTableRowActions
          row={row}
          setRow={setRow}
          openDeleteModal={() => {
            setRow(row.original)
            setOpenDeleteModal(true)
          }}
          openEditModal={() => {
            setRow(row.original)
            setEditing(true)
            setOpenFormModal(true)
          }}
        />
      ),
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
    <div className="container mx-auto py-10">
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setRow(ARTICULO_DEFAULT_VALUES)
            setEditing(false)
            setOpenFormModal(true)
          }}>
          Nuevo Artículo
        </Button>
      </div>
      <DeleteEntityForm
        openDeleteForm={openDeleteModal}
        setOpenDeleteForm={setOpenDeleteModal}
        entity={row}
        apiKey="/api/articulos"
        name="articulo"
      />
      <CreateEditEntityModal
        open={openFormModal}
        onOpenChange={() => setOpenFormModal(!openFormModal)}
        editing={editing}
        name="articulo">
        <ArticuloFormContent
          onFormSubmit={() => setOpenFormModal(!openFormModal)}
          articulo={row}
          tipoArticulos={tipoArticulos}
          talles={talles}
          editing={editing}
        />
      </CreateEditEntityModal>
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
