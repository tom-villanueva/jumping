'use client'
import { saveEquipo } from '../../actions'
import EquipoFormContent from './EquipoFormContent'
import { EquipoTipoArticuloContextProvider } from './EquipoTipoArticuloContext'

export default function EquipoForm({
  tipoArticulos,
  closeDialog,
  equipo = {},
  serverAction = saveEquipo,
}) {
  return (
    <EquipoTipoArticuloContextProvider
      tipoArticulos={tipoArticulos}
      // Le saco el atributo pivot
      defaultSelected={equipo?.equipo_tipo_articulo?.map(
        ({ pivot, ...rest }) => rest,
      )}>
      <EquipoFormContent
        closeDialog={closeDialog}
        equipo={equipo}
        serverAction={serverAction}
      />
    </EquipoTipoArticuloContextProvider>
  )
}
