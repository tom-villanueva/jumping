import { createContext, useState } from 'react'

const EquipoTipoArticuloContext = createContext(null)

export default EquipoTipoArticuloContext

export const EquipoTipoArticuloContextProvider = ({
  children,
  tipoArticulos,
}) => {
  const [selected, setSelected] = useState([])
  const [filteredTipoArticulos, setFilteredTipoArticulos] = useState(
    tipoArticulos,
  )

  function addTipoArticulo(tipoArticuloId) {
    const tipo = tipoArticulos.find(tipo => tipo.id === tipoArticuloId)
    const newSelected = [...selected, tipo]
    setSelected(newSelected)

    const selectedVals = newSelected.map(s => s.id)

    const filteredTipos = tipoArticulos.filter(
      tipo => !selectedVals.includes(tipo.id),
    )
    setFilteredTipoArticulos(filteredTipos)
  }

  function deleteTipoArticulo(tipoArticuloId) {
    const newSelected = selected.filter(tipo => tipo.id !== tipoArticuloId)
    setSelected(newSelected)

    const selectedVals = newSelected.map(s => s.id)

    const filteredTipos = tipoArticulos.filter(
      tipo => !selectedVals.includes(tipo.id),
    )
    setFilteredTipoArticulos(filteredTipos)
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
