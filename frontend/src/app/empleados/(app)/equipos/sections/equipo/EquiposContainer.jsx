'use client'
import { DataTable } from '../data-table'
import { useEffect, useState } from 'react'
import { Button } from '@/components/ui/button'
import {
  Check,
  CircleDollarSign,
  CirclePercent,
  Edit,
  Trash,
  X,
} from 'lucide-react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import { SelectManyEntitiesContextProvider } from '../SelectManyEntitiesContext'
import EquipoFormContent from './EquipoFormContent'
import EquipoThumbnailUploadInput from './EquipoThumbnailUploadInput'
import EquipoDescuentoFormModal from './equipo-descuento/EquipoDescuentoFormModal'
import EquipoPrecioFormModal from './equipo-precio/EquipoPrecioFormModal'
import { useDescuentos } from '@/services/descuentos'
import { useTipoArticulos } from '@/services/tipo-articulos'
import { useEquipos } from '@/services/equipos'
import { useDebounce } from '@/hooks/useDebounce'
import EquiposTable from './EquiposTable'

const EQUIPO_DEFAULT_VALUES = {
  descripcion: '',
  precio: 0,
  disponible: false,
}

export default function EquiposContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [openDescuentoForm, setOpenDescuentoForm] = useState(false)
  const [openPrecioForm, setOpenPrecioForm] = useState(false)
  const [selectedEquipo, setSelectedEquipo] = useState(EQUIPO_DEFAULT_VALUES)

  const {
    descuentos,
    isLoading: isLoadingDescuentos,
    isError: isErrorDescuentos,
  } = useDescuentos({ params: {}, filters: [] })

  const {
    tipoArticulos,
    isLoading: isLoadingTipoArticulos,
    isError: isErrorTipoArticulos,
  } = useTipoArticulos({ params: {}, filters: [] })

  const [columnFilters, setColumnFilters] = useState([])
  const debouncedColumnFilters = useDebounce(columnFilters, 1000)
  const [pagination, setPagination] = useState({
    pageIndex: 0, //initial page index
    pageSize: 10, //default page size
  })

  const { equipos, isLoading, isError, isValidating } = useEquipos({
    params: {
      page: pagination.pageIndex + 1,
      page_size: pagination.pageSize,
      include: 'equipo_tipo_articulo,descuentos_vigentes,precios_vigentes',
      sort: 'id',
    },
    filters: debouncedColumnFilters,
  })

  const columns = [
    {
      accessorKey: 'id',
      header: 'Id',
    },
    {
      accessorKey: 'descripcion',
      header: 'Descripción',
    },
    {
      accessorKey: 'precio_vigente',
      header: 'Precio Hoy',
      cell: ({ row }) => {
        const precioVigente = row.getValue('precio_vigente')
        const formatted = new Intl.NumberFormat('es-AR', {
          style: 'currency',
          currency: 'ARS',
        }).format(precioVigente?.precio)

        return <div className="font-medium">{formatted}</div>
      },
    },
    {
      accessorKey: 'disponible',
      header: 'Visible',
      cell: ({ row }) => {
        const disponible = row.getValue('disponible')

        return (
          <div>
            {disponible ? (
              <Check className="h-6 w-6 text-emerald-600" />
            ) : (
              <X className="h-6 w-6 text-rose-600" />
            )}
          </div>
        )
      },
    },
    {
      accessorKey: 'equipo_tipo_articulo',
      header: 'Compuesto por',
      cell: ({ row }) => {
        const tipo_articulos = row.getValue('equipo_tipo_articulo')

        return (
          <ul>
            {tipo_articulos.map(tipo => (
              <li key={tipo.id} className="">
                {'❄️ '}
                {tipo.descripcion}
              </li>
            ))}
          </ul>
        )
      },
    },
    {
      accessorKey: 'precios',
      header: 'Precios',
      cell: ({ row }) => {
        const equipo = row.original

        return (
          <Button
            variant="outline"
            type="button"
            onClick={() => {
              setSelectedEquipo(equipo)
              setOpenPrecioForm(true)
            }}>
            <CircleDollarSign className="h-4 w-4" />
          </Button>
        )
      },
    },
    {
      accessorKey: 'descuentos',
      header: 'Descuentos',
      cell: ({ row }) => {
        const equipo = row.original

        return (
          <Button
            variant="outline"
            type="button"
            onClick={() => {
              setSelectedEquipo(equipo)
              setOpenDescuentoForm(true)
            }}>
            <CirclePercent className="h-4 w-4" />
          </Button>
        )
      },
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const equipo = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedEquipo(equipo)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedEquipo(equipo)
                setOpenDeleteForm(true)
              }}>
              <Trash className="h-4 w-4" />
            </Button>
          </div>
        )
      },
    },
  ]

  useEffect(() => {
    // Esto lo hice para que se recargue la imagen al subirla
    // funciona, no sé si es la mejor solución
    // también sirve para cuando se cargan descuentos a un equipo
    if (selectedEquipo?.hasOwnProperty('id')) {
      const newSelectedEquipo = equipos?.data?.find(
        equipo => equipo.id === selectedEquipo.id,
      )
      setSelectedEquipo(newSelectedEquipo)
    }
  }, [equipos])

  return (
    <div>
      <DeleteEntityForm
        openDeleteForm={openDeleteForm}
        setOpenDeleteForm={setOpenDeleteForm}
        entity={selectedEquipo}
        apiKey="/api/equipos"
        name="equipo"
      />
      <EquipoDescuentoFormModal
        open={openDescuentoForm}
        onOpenChange={() => setOpenDescuentoForm(!openDescuentoForm)}
        equipo={selectedEquipo}
        descuentos={descuentos}
        descuentosVigentes={selectedEquipo?.descuentos_vigentes}
      />
      <EquipoPrecioFormModal
        open={openPrecioForm}
        onOpenChange={() => setOpenPrecioForm(!openPrecioForm)}
        equipo={selectedEquipo}
        preciosVigentes={selectedEquipo?.precios_vigentes}
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedEquipo(EQUIPO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Equipo
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="equipo">
        {editing && <EquipoThumbnailUploadInput equipo={selectedEquipo} />}
        <EquipoFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          equipo={selectedEquipo}
          tipoArticulos={tipoArticulos}
          editing={editing}
        />
      </CreateEditEntityModal>
      <EquiposTable
        columns={columns}
        equipos={equipos}
        isLoading={isLoading}
        isValidating={isValidating}
        isError={isError}
        columnFilters={columnFilters}
        setColumnFilters={setColumnFilters}
        pagination={pagination}
        setPagination={setPagination}
      />
    </div>
  )
}
