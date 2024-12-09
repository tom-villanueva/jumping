import React from 'react'
import ProductBox from './ProductBox.js'
import Order from './Order.js'
import Filters from './Filters.js'
import { useState } from 'react'
import { useContext } from 'react'
import FormContext from '../../context/FormContext.jsx'
import { z } from 'zod'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'

const schema = z.object({
  equipos: z
    .array(
      z.object({
        equipo_id: z.string(),
        nombre: z.string(),
        apellido: z.string(),
      }),
    )
    .min(1, 'At least one equipment must be selected'),
  traslados: z
    .array(
      z.object({
        direccion: z.string(),
        fecha_desde: z.date(),
        fecha_hasta: z.date(),
      }),
    )
    .optional(),
})

export default function EquipmentStep({ onNext, onBack, setBgStyle }) {
  const [esquiFilter, handleEsquiFilter] = useState(true)
  const [snowboardFilter, handleSnowboardFilter] = useState(true)
  const [equiposFilter, handleEquiposFilter] = useState(true)
  const [accesoriosFilter, handleAccesoriosFilter] = useState(true)
  const {
    range,
    products,
    selectedEquipos,
    selectedTraslados,
    createEquipoHandlers,
    createTrasladoHandlers,
  } = useContext(FormContext)

  const { register, handleSubmit, setValue, getValues } = useForm({
    defaultValues: { equipos: selectedEquipos, traslados: selectedTraslados },
    resolver: zodResolver(schema),
  })

  const { addEquipo, updateEquipo, removeEquipo } = createEquipoHandlers(
    setValue,
    getValues,
  )

  const { addTraslado, updateTraslado, removeTraslado } =
    createTrasladoHandlers(setValue, getValues)

  const onSubmit = data => {
    console.log(data)
    // setSelectedEquipos(data.equipos)
    setBgStyle(1)
    onNext()
  }

  function handleFilter(filter) {
    console.log(filter)

    if (filter == 'esqui') {
      handleEsquiFilter(!esquiFilter)
    } else if (filter == 'snowboard') {
      handleSnowboardFilter(!snowboardFilter)
    } else if (filter == 'equipos') {
      handleEquiposFilter(!equiposFilter)
    } else if (filter == 'accesorios') {
      handleAccesoriosFilter(!accesoriosFilter)
    }
  }

  return (
    <div className="flex flex-col items-center justify-center">
      <p className="mt-5 text-center font-montserrat uppercase text-black">
        {range.from.toLocaleDateString('es-AR', {
          year: 'numeric',
          month: '2-digit',
          day: '2-digit',
        })}{' '}
        -{' '}
        {range.to.toLocaleDateString('es-AR', {
          year: 'numeric',
          month: '2-digit',
          day: '2-digit',
        })}
      </p>
      <div className="flex w-full flex-col items-center justify-center">
        <Filters
          handleFilter={handleFilter}
          esquiFilter={esquiFilter}
          snowboardFilter={snowboardFilter}
          equiposFilter={equiposFilter}
          accesoriosFilter={accesoriosFilter}
        />
      </div>
      <form onSubmit={handleSubmit(onSubmit)}>
        <div className="flex flex-col items-center justify-center">
          <div
            className={`overflow-hidden transition-all duration-700 ease-in-out ${
              esquiFilter
                ? 'my-3 my-3 flex max-h-full w-full items-center justify-center opacity-100'
                : 'max-h-0 opacity-0'
            }`}>
            <ProductBox title={'Esqui'} />
          </div>
          <div
            className={`overflow-hidden transition-all duration-700 ease-in-out ${
              snowboardFilter
                ? 'my-3 flex max-h-full w-full items-center justify-center opacity-100'
                : 'max-h-0 opacity-0'
            }`}>
            <ProductBox title={'Snowboard'} />
          </div>
          <div
            className={`overflow-hidden transition-all duration-700 ease-in-out ${
              equiposFilter
                ? 'my-3 flex max-h-full w-full items-center justify-center opacity-100'
                : 'max-h-0 opacity-0'
            }`}>
            <ProductBox title={'Equipos'} />
          </div>
          <div
            className={`overflow-hidden transition-all duration-700 ease-in-out ${
              accesoriosFilter
                ? 'my-3 flex max-h-full w-full items-center justify-center opacity-100'
                : 'max-h-0 opacity-0'
            }`}>
            <ProductBox title={'Accesorios'} />
          </div>
        </div>
        <div className="flex w-full flex-col items-center justify-center">
          <Order setBgStyle={setBgStyle} />
        </div>
      </form>
    </div>
  )
}
