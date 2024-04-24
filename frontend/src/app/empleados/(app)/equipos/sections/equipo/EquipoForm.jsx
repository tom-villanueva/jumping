'use client'
import EquipoFormContent from './EquipoFormContent'
import { EquipoTipoArticuloContextProvider } from './EquipoTipoArticuloContext'

export default function EquipoForm({ tipoArticulos, closeDialog }) {
  return (
    <EquipoTipoArticuloContextProvider tipoArticulos={tipoArticulos}>
      <EquipoFormContent closeDialog={closeDialog} />
    </EquipoTipoArticuloContextProvider>
  )
}
