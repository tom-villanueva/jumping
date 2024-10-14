'use client'
import { useState } from 'react'
import { Button } from '@/components/ui/button'
import { Edit, Trash } from 'lucide-react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import TipoArticuloFormContent from './TipoArticuloFormContent'
import TipoArticulosTable from './TipoArticulosTable'
// import { SelectManyEntitiesContextProvider } from '../SelectManyEntitiesContext'
import { useTalles } from '@/services/talles'

const TIPO_ARTICULO_DEFAULT_VALUES = {
  descripcion: '',
}

export default function TipoArticulosContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedTipoArticulo, setSelectedTipoArticulo] = useState(
    TIPO_ARTICULO_DEFAULT_VALUES,
  )

  const {
    talles,
    isLoading: isLoadingTalles,
    isError: isErrorTalles,
  } = useTalles({
    params: {
      sort: 'id',
    },
    filters: [],
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
    // {
    //   accessorKey: 'talles',
    //   header: 'Talles',
    //   cell: ({ row }) => {
    //     const talles = row.getValue('talles')

    //     return (
    //       <ul>
    //         {talles.map(talle => (
    //           <li key={talle.id} className="">
    //             {'❄️ '}
    //             {talle.descripcion}
    //           </li>
    //         ))}
    //       </ul>
    //     )
    //   },
    // },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const tipoArticulo = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedTipoArticulo(tipoArticulo)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedTipoArticulo(tipoArticulo)
                setOpenDeleteForm(true)
              }}>
              <Trash className="h-4 w-4" />
            </Button>
          </div>
        )
      },
    },
  ]

  return (
    <div>
      <DeleteEntityForm
        openDeleteForm={openDeleteForm}
        setOpenDeleteForm={setOpenDeleteForm}
        entity={selectedTipoArticulo}
        apiKey="/api/tipo-articulos"
        name="tipo de artículo"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedTipoArticulo(TIPO_ARTICULO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Tipo de Artículo
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="tipo de artículo">
        {/* <SelectManyEntitiesContextProvider
          entities={talles}
          defaultSelected={selectedTipoArticulo?.talles?.map(
            // Le saco el atributo pivot
            ({ pivot, ...rest }) => rest,
          )}> */}
        <TipoArticuloFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          tipoArticulo={selectedTipoArticulo}
          talles={talles}
          editing={editing}
        />
        {/* </SelectManyEntitiesContextProvider> */}
      </CreateEditEntityModal>
      <TipoArticulosTable columns={columns} />
    </div>
  )
}
