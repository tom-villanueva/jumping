'use client'
import { useState } from 'react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import { Button } from '@/components/ui/button'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import { Edit, Trash } from 'lucide-react'
import ModeloFormContent from './ModeloFormContent'
import ModelosTable from './ModelosTable'

const MODELO_DEFAULT_VALUES = {
  descripcion: '',
  marca_id: '',
}

export default function ModelosContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedModelo, setSelectedModelo] = useState(MODELO_DEFAULT_VALUES)

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
      accessorKey: 'marca',
      header: 'Marca',
      cell: ({ row }) => {
        const modelo = row.original
        return <span>{modelo.marca?.descripcion ?? ''}</span>
      },
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const modelo = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedModelo(modelo)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedModelo(modelo)
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
        entity={selectedModelo}
        apiKey="/api/modelos"
        name="modelo"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedModelo(MODELO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Modelo
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="modelo">
        <ModeloFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          modelo={selectedModelo}
          editing={editing}
        />
      </CreateEditEntityModal>
      <ModelosTable columns={columns} />
    </div>
  )
}
