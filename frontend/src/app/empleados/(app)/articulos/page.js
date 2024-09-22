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
  const [row, setRow] = useState(null)
  const [openDeleteModal, setOpenDeleteModal] = useState(false)
  const [openFormModal, setOpenFormModal] = useState(false)
  const [editing, setEditing] = useState(false)

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
      accessorKey: 'tipo_articulo.descripcion',
      id: 'tipo_articulo.id',
      header: 'Tipo',
    },
    {
      accessorKey: 'talle.descripcion',
      id: 'talle.id',
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
      <ArticulosTable columns={columns} />
    </div>
  )
}
