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
  const [range, setDateRange] = useState(initialState.initialRange)
  const [products, setProducts] = useState([])
  const [selectedProducts, setSelectedProducts] = useState([])
  const [selectedTraslados, setSelectedTraslados] = useState([])
  const [titular, setTitular] = useState({
    nombre: '',
    apellido: '',
    fecha_nacimiento: '',
    email: '',
    telefono: '',
  })

  const value = {
    range,
    setDateRange,
    products,
    setProducts,
    selectedProducts,
    setSelectedProducts,
    selectedTraslados,
    setSelectedTraslados,
    titular,
    setTitular,
  }

  return (
    <FormContentContext.Provider value={value}>
      {children}
    </FormContentContext.Provider>
  )
}
