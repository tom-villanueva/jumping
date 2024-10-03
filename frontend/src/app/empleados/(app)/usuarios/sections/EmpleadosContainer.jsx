import { Button } from '@/components/ui/button'
import { DataTable } from '../../equipos/sections/data-table'
import { Edit, Trash } from 'lucide-react'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import { useAuth } from '@/hooks/auth-empleados'
import { useState } from 'react'
import CreateEditEntityModal from '@/components/crud/CreateEditEntityModal'
import EmpleadoFormContent from './EmpleadoFormContent'

const EMPLEADO_DEFAULT_VALUES = {
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  isAdmin: false,
}

export default function EmpleadosContainer({ empleados }) {
  const { user } = useAuth({ middleware: 'auth' })

  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedEmpleado, setSelectedEmpleado] = useState(
    EMPLEADO_DEFAULT_VALUES,
  )

  const columns = [
    {
      accessorKey: 'id',
      header: 'Id',
    },
    {
      accessorKey: 'name',
      header: 'Nombre',
    },
    {
      accessorKey: 'email',
      header: 'Email',
    },
    {
      accessorKey: 'isAdmin',
      header: 'Es Admin',
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const empleado = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedEmpleado(empleado)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            {user.id !== empleado.id && (
              <Button
                variant="destructive"
                type="button"
                onClick={() => {
                  setSelectedEmpleado(empleado)
                  setOpenDeleteForm(true)
                }}>
                <Trash className="h-4 w-4" />
              </Button>
            )}
          </div>
        )
      },
    },
  ]

  return (
    <div>
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedEmpleado(EMPLEADO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Empleado
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="empleado">
        <EmpleadoFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          empleado={selectedEmpleado}
          editing={editing}
        />
      </CreateEditEntityModal>
      <DeleteEntityForm
        openDeleteForm={openDeleteForm}
        setOpenDeleteForm={setOpenDeleteForm}
        entity={selectedEmpleado}
        apiKey="/api/empleados"
        name="empleado"
      />
      <DataTable columns={columns} data={empleados} />
    </div>
  )
}
