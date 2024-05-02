import { createContext, useEffect, useState } from 'react'

const EquipoTipoArticuloContext = createContext(null)

export default EquipoTipoArticuloContext

export const EquipoTipoArticuloContextProvider = ({
  children,
  defaultSelected = [],
  tipoArticulos,
}) => {
  const [selected, setSelected] = useState(defaultSelected)
  const [filteredTipoArticulos, setFilteredTipoArticulos] = useState(
    tipoArticulos,
  )

  useEffect(() => {
    const selectedVals = selected.map(s => s.id)

    const filteredTipos = tipoArticulos.filter(
      tipo => !selectedVals.includes(tipo.id),
    )

    setFilteredTipoArticulos(filteredTipos)
  }, [selected])

  function addTipoArticulo(tipoArticuloId) {
    const tipo = tipoArticulos.find(tipo => tipo.id === tipoArticuloId)
    const newSelected = [...selected, tipo]
    setSelected(newSelected)
  }

  function deleteTipoArticulo(tipoArticuloId) {
    const newSelected = selected.filter(tipo => tipo.id !== tipoArticuloId)
    setSelected(newSelected)
  }

  const value = {
    tipoArticulos,
    selected,
    filteredTipoArticulos,
    addTipoArticulo,
    deleteTipoArticulo,
  }

  return (
    <EquipoTipoArticuloContext.Provider value={value}>
      {children}
    </EquipoTipoArticuloContext.Provider>
  )
}
