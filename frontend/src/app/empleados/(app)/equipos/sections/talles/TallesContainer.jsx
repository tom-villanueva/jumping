'use client'
import { useState } from 'react'
import { editTalle, removeTalle, saveTalle } from '../../talles-actions'
import DeleteEntityForm from '../DeleteEntityForm'
import { DataTable } from '../data-table'
import { Button } from '@/components/ui/button'
import { Edit, Trash } from 'lucide-react'
import TalleFormContent from './TalleFormContent'
import CreateEditEntityModal from '../CreateEditEntityModal'

const TALLE_DEFAULT_VALUES = {
  descripcion: '',
}

export default function TallesContainer({ talles }) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedTalle, setSelectedTalle] = useState(TALLE_DEFAULT_VALUES)

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
    //   accessorKey: 'tipo_articulo_talle',
    //   header: 'Asociado a',
    //   cell: ({ row }) => {
    //     const tipo_articulos = row.getValue('tipo_articulo_talle')

    //     return (
    //       <ul>
    //         {tipo_articulos.map(tipo => (
    //           <li key={tipo.id} className="">
    //             {tipo.descripcion}
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
        const talle = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              onClick={() => {
                setSelectedTalle(talle)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              onClick={() => {
                setSelectedTalle(talle)
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
        entity={selectedTalle}
        serverAction={removeTalle}
        name="talle"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedTalle(TALLE_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Talle
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="talle">
        <TalleFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          talle={selectedTalle}
          serverAction={editing ? editTalle : saveTalle}
        />
      </CreateEditEntityModal>
      <DataTable columns={columns} data={talles} />
    </div>
  )
}
