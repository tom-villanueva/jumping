import { columns } from './columns'
import { DataTable } from '../data-table'
import CreateEquipoForm from './CreateEquipoForm'

export default function EquiposContainer({ equipos }) {
  return (
    <div>
      <CreateEquipoForm />
      <DataTable columns={columns} data={equipos} />
    </div>
  )
}
