'use client'
import { useState } from 'react'
import { Button } from '@/components/ui/button'
import { Edit, Trash } from 'lucide-react'
import ClientesTable from './ClientesTable'
import ClienteFormContent from './ClienteFormContent'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import CreateEditEntityModal from '@/components/crud/CreateEditEntityModal'

const CLIENTE_DEFAULT_VALUES = {
  nombre: '',
  apellido: '',
  email: '',
  telefono: '',
  tipo_persona_id: '',
}

export default function ClientesContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedCliente, setSelectedCliente] = useState(CLIENTE_DEFAULT_VALUES)

  const columns = [
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
      header: 'Teléfono',
      accessorKey: 'telefono',
      accessorFn: row =>
        `${row.telefono && row.telefono !== '' ? row.telefono : '-'}`,
    },
    {
      header: 'Tier',
      id: 'tipo_persona_id',
      accessorFn: row =>
        `${row.tipo_persona ? row.tipo_persona.descripcion : '-'}`,
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const marca = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedCliente(marca)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedCliente(marca)
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
        entity={selectedCliente}
        apiKey="/api/clientes"
        name="cliente"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedCliente(CLIENTE_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Cliente
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="cliente">
        <ClienteFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          cliente={selectedCliente}
          editing={editing}
        />
      </CreateEditEntityModal>
      <ClientesTable columns={columns} />
    </div>
  )
}
