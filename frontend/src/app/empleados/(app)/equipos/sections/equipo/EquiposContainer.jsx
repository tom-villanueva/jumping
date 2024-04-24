import { columns } from './columns'
import { DataTable } from '../data-table'
import CreateEquipoForm from './CreateEquipoForm'

export default function EquiposContainer({ equipos, tipoArticulos }) {
  return (
    <div>
      <CreateEquipoForm tipoArticulos={tipoArticulos} />
      <DataTable columns={columns} data={equipos} />
    </div>
  )
}
