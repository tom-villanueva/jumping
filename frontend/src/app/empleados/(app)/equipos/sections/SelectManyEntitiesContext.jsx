import { createContext, useEffect, useState } from 'react'

const SelectManyEntitiesContext = createContext(null)

export default SelectManyEntitiesContext

export const SelectManyEntitiesContextProvider = ({
  children,
  defaultSelected = [],
  entities,
}) => {
  const [selected, setSelected] = useState(defaultSelected)
  const [filteredEntities, setFilteredEntities] = useState(
    entities,
  )

  // useEffect(() => {
  //   const selectedVals = selected.map(s => s.id)

  //   const filteredEntities = entities.filter(
  //     tipo => !selectedVals.includes(tipo.id),
  //   )

  //   setFilteredEntities(filteredEntities)
  // }, [selected])

  function updateFilteredEntities(newSelected) {
    const selectedVals = newSelected.map(s => s.id)

    const filteredEntities = entities.filter(
      entity => !selectedVals.includes(entity.id),
    )

    setFilteredEntities(filteredEntities)
  }

  function addEntity(entityId) {
    const entity = entities.find(entity => entity.id === entityId)
    const newSelected = [...selected, entity]
    setSelected(newSelected)
    updateFilteredEntities(newSelected)
  }

  function deleteEntity(entityId) {
    const newSelected = selected.filter(entity => entity.id !== entityId)
    setSelected(newSelected)
    updateFilteredEntities(newSelected)
  }

  const value = {
    entities,
    selected,
    filteredEntities,
    addEntity,
    deleteEntity,
  }

  return (
    <SelectManyEntitiesContext.Provider value={value}>
      {children}
    </SelectManyEntitiesContext.Provider>
  )
}
