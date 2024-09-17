'use client'

import { DataTable } from '@/components/client-table/data-table'
import { useDebounce } from '@/hooks/useDebounce'
import { convertToUTC, formatDate } from '@/lib/utils'
import { useEstados } from '@/services/estados'
import { useReservas } from '@/services/reservas'
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
import ReservaFormContent from './ReservaFormContent'
import { Button } from '@/components/ui/button'
import CreateEditEntityModal from '@/components/crud/CreateEditEntityModal'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import ReservaTableActions from './ReservaTableActions'
import { useRouter } from 'next/navigation'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

const RESERVA_DEFAULT_VALUES = {
  fecha_prueba: today,
  fecha_desde: today,
  fecha_hasta: '',
  comentario: '',
  estado_id: '1',
  nombre: '',
  apellido: '',
  email: '',
  telefono: '',
}

export default function ReservasContainer() {
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

  const router = useRouter()

  useEffect(() => {
    if (setPagination) {
      setPagination(pagination => ({
        pageIndex: 0,
        pageSize: pagination.pageSize,
      }))
    }
  }, [columnFilters, setPagination])

  const { reservas, isLoading, isError } = useReservas({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      sort: 'fecha_desde',
      include: 'estado',
    },
    filters: debouncedColumnFilters,
  })

  const { estados, isLoading: isLoadingEstados } = useEstados({})

  const columns = [
    {
      id: 'acciones',
      cell: ({ row }) => (
        <ReservaTableActions
          row={row.original}
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
    {
      header: 'Nro',
      accessorKey: 'id',
      enableColumnFilter: false,
    },
    {
      header: 'Apellido',
      accessorKey: 'apellido',
    },
    {
      header: 'Nombre',
      accessorKey: 'nombre',
    },
    {
      header: 'Email',
      accessorKey: 'email',
    },
    {
      accessorKey: 'estado.descripcion',
      id: 'estado_id',
      header: 'Estado',
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
    {
      accessorKey: 'fecha_prueba',
      header: 'Fecha Prueba',
      accesorFn: row => convertToUTC(row.fecha_prueba).toLocaleDateString(),
      cell: ({ row }) => {
        return (
          <span>
            {convertToUTC(row.original.fecha_prueba).toLocaleDateString()}
          </span>
        )
      },
    },
    // {
    //   accessorKey: 'comentario',
    //   header: 'Comentario',
    // },
  ]

  const table = useReactTable({
    data: reservas?.data || [],
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

    rowCount: reservas?.total,

    manualPagination: true,
    manualSorting: true,
    manualFiltering: true,
  })

  if (isError) {
    return <p>Error cargando las reservas...</p>
  }

  return (
    <>
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setRow(RESERVA_DEFAULT_VALUES)
            setEditing(false)
            setOpenFormModal(true)
          }}>
          Nueva reserva
        </Button>
      </div>
      <DeleteEntityForm
        openDeleteForm={openDeleteModal}
        setOpenDeleteForm={setOpenDeleteModal}
        entity={row}
        apiKey="/api/reservas"
        name="reserva"
      />
      <CreateEditEntityModal
        open={openFormModal}
        onOpenChange={() => setOpenFormModal(!openFormModal)}
        editing={editing}
        name="reserva">
        <ReservaFormContent
          onFormSubmit={() => setOpenFormModal(!openFormModal)}
          reserva={row}
          estados={estados}
          editing={editing}
        />
      </CreateEditEntityModal>
      <DataTable
        handleClick={row => {
          router.push(`reservas/${row.id}`)
        }}
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
            columnName: 'apellido',
            title: 'Apellido',
            options: [],
          },
          {
            type: 'text',
            columnName: 'email',
            title: 'Email',
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
          {
            type: 'select',
            columnName: 'estado_id',
            title: 'Estados',
            options:
              estados?.map(estado => ({
                label: estado.descripcion,
                value: estado.id,
                icon: DotIcon,
              })) ?? [],
          },
        ]}
      />
    </>
  )
}
