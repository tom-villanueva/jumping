import { createContext, useState } from 'react'
import { addDays } from 'date-fns'

const FormContentContext = createContext(null)

export default FormContentContext

export const FormContextProvider = ({
  children,
  initialState = {
    initialRange: {
      from: new Date(),
      to: addDays(new Date(), 2),
    },
  },
}) => {
  const [range, setRange] = useState(initialState.initialRange)
  const [products, setProducts] = useState([])
  const [selectedEquipos, setSelectedEquipos] = useState([])
  const [selectedTraslados, setSelectedTraslados] = useState([])
  const [titular, setTitular] = useState({
    nombre: '',
    apellido: '',
    fecha_nacimiento: '',
    email: '',
    telefono: '',
  })

  const createEquipoHandlers = (setValue, getValues) => ({
    addEquipo: equipoId => {
      const updated = [
        ...getValues('equipos'),
        { equipo_id: equipoId, nombre: '', apellido: '' },
      ]
      setSelectedEquipos(updated)
      setValue('equipos', updated)
    },

    updateEquipo: (index, field, value) => {
      const updated = getValues('equipos').map((equipo, i) =>
        i === index ? { ...equipo, [field]: value } : equipo,
      )
      setSelectedEquipos(updated)
      setValue('equipos', updated)
    },

    removeEquipo: equipoId => {
      const updated = getValues('equipos').filter(
        equipo => equipo.equipo_id !== equipoId,
      )
      setSelectedEquipos(updated)
      setValue('equipos', updated)
    },
  })

  const createTrasladoHandlers = (setValue, getValues) => ({
    addTraslado: (direccion, fechaDesde, fechaHasta) => {
      const updated = [
        ...getValues('traslados'),
        { direccion, fecha_desde: fechaDesde, fecha_hasta: fechaHasta },
      ]
      setSelectedTraslados(updated)
      setValue('traslados', updated)
    },

    updateTraslado: (index, field, value) => {
      const updated = getValues('traslados').map((traslado, i) =>
        i === index ? { ...traslado, [field]: value } : traslado,
      )
      setSelectedTraslados(updated)
      setValue('traslados', updated)
    },

    removeTraslado: index => {
      const updated = getValues('traslados').filter((_, i) => i !== index)
      setSelectedTraslados(updated)
      setValue('traslados', updated)
    },
  })

  const value = {
    range,
    setRange,
    products,
    setProducts,
    selectedEquipos,
    setSelectedEquipos,
    selectedTraslados,
    setSelectedTraslados,
    titular,
    setTitular,
    createEquipoHandlers,
    createTrasladoHandlers,
  }

  return (
    <FormContentContext.Provider value={value}>
      {children}
    </FormContentContext.Provider>
  )
}
