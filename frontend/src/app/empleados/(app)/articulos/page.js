'use client'

import { DataTableRowActions } from '@/components/client-table/data-table-row-actions'
import CreateEditEntityModal from '@/components/crud/CreateEditEntityModal'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import { useTalles } from '@/services/talles'
import { useTipoArticulos } from '@/services/tipo-articulos'
import { useState } from 'react'
import ArticuloFormContent from './ArticuloFormContent'
import { Button } from '@/components/ui/button'
import ArticulosTable from './ArticulosTable'
import { useMarcas } from '@/services/marcas'
import { useModelos } from '@/services/modelos'
import Header from '../Header'

const ARTICULO_DEFAULT_VALUES = {
  descripcion: '',
  codigo: '',
  observacion: '',
  tipo_articulo_id: '',
  talle_id: '',
  marca_id: '',
  modelo_id: '',
  nro_serie: '',
  disponible: true,
}

export default function ArticulosPage() {
  const [row, setRow] = useState(null)
  const [openDeleteModal, setOpenDeleteModal] = useState(false)
  const [openFormModal, setOpenFormModal] = useState(false)
  const [editing, setEditing] = useState(false)

  const { tipoArticulos, isLoading: isLoadingTipoArticulos } = useTipoArticulos(
    {},
  )

  const { talles, isLoading: isLoadingTalles } = useTalles({})

  const { marcas, isLoading: isLoadingMarcas } = useMarcas({})

  const { modelos, isLoading: isLoadingModelos } = useModelos({})

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
      accessorKey: 'tipo_articulo.descripcion',
      id: 'tipo_articulo_id',
      header: 'Tipo',
    },
    {
      accessorKey: 'talle.descripcion',
      id: 'talle_id',
      header: 'Talle',
    },
    {
      accessorKey: 'marca.descripcion',
      id: 'marca_id',
      header: 'Marca',
    },
    {
      accessorKey: 'modelo.descripcion',
      id: 'modelo_id',
      header: 'Modelo',
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

  return (
    <>
      <Header title="Artículos" />
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
            marcas={marcas}
            modelos={modelos}
            editing={editing}
          />
        </CreateEditEntityModal>
        <ArticulosTable columns={columns} />
      </div>
    </>
  )
}
