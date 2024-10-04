import { Button } from '@/components/ui/button'
import { Edit, Trash } from 'lucide-react'
import DeleteEntityForm from '@/components/crud/DeleteEntityForm'
import { useState } from 'react'
import CreateEditEntityModal from '@/components/crud/CreateEditEntityModal'
import UserFormContent from './UserFormContent'
import UsersTable from './UsersTable'

const USER_DEFAULT_VALUES = {
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
}

export default function UsersContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedUser, setSelectedUser] = useState(USER_DEFAULT_VALUES)

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
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const user = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedUser(user)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedUser(user)
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
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedUser(USER_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo User
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="user">
        <UserFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          user={selectedUser}
          editing={editing}
        />
      </CreateEditEntityModal>
      <DeleteEntityForm
        openDeleteForm={openDeleteForm}
        setOpenDeleteForm={setOpenDeleteForm}
        entity={selectedUser}
        apiKey="/api/users"
        name="user"
      />
      <UsersTable columns={columns} />
    </div>
  )
}
