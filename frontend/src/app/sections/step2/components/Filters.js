import React from 'react'
import { useState } from 'react'

export default function Filters({
  handleFilter,
  esquiFilter,
  snowboardFilter,
  equiposFilter,
  accesoriosFilter,
}) {
  const [display, setDisplay] = useState(false)

  function displayFilters() {
    setDisplay(!display)
  }

  return (
    <div className="my-10 w-full rounded-lg bg-zinc-900 text-center">
      <p className="mt-5 font-montserrat text-lg font-bold">Filtrar</p>

      <div className="my-5 hidden w-full flex-col items-center justify-center gap-5 sm:flex sm:flex-row">
        <button
          className={
            esquiFilter
              ? 'rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
              : 'rounded-full border-2 border-white px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
          }
          onClick={() => handleFilter('esqui')}
          type="button">
          Esqui
        </button>
        <button
          className={
            snowboardFilter
              ? 'rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
              : 'rounded-full border-2 border-white px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
          }
          onClick={() => handleFilter('snowboard')}
          type="button">
          Snowboard
        </button>
        <button
          className={
            equiposFilter
              ? 'rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
              : 'rounded-full border-2 border-white px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
          }
          onClick={() => handleFilter('equipos')}
          type="button">
          Equipos
        </button>
        <button
          className={
            accesoriosFilter
              ? 'rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
              : 'rounded-full border-2 border-white px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
          }
          onClick={() => handleFilter('accesorios')}
          type="button">
          Accesorios
        </button>
        <button
          className="rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800"
          type="button">
          Menor-Mayor
        </button>
      </div>

      <div className="mb-5 flex w-full flex-col items-center justify-center gap-2 sm:hidden">
        <button
          className="font-aleo mb-2 font-archivo"
          type="button"
          onClick={() => displayFilters()}>
          {display ? '^' : 'V'}
        </button>
        <div
          className={`grid grid-cols-2 gap-2 overflow-hidden transition-all duration-500 ease-in-out ${
            display ? 'max-h-screen opacity-100' : 'max-h-0 opacity-0'
          }`}>
          <button
            className={
              esquiFilter
                ? 'rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
                : 'rounded-full border-2 border-white px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
            }
            onClick={() => handleFilter('esqui')}
            type="button">
            Esqui
          </button>
          <button
            className={
              snowboardFilter
                ? 'rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
                : 'rounded-full border-2 border-white px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
            }
            onClick={() => handleFilter('snowboard')}
            type="button">
            Snowboard
          </button>
          <button
            className={
              equiposFilter
                ? 'rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
                : 'rounded-full border-2 border-white px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
            }
            onClick={() => handleFilter('equipos')}
            type="button">
            Equipos
          </button>
          <button
            className={
              accesoriosFilter
                ? 'rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
                : 'rounded-full border-2 border-white px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800'
            }
            onClick={() => handleFilter('accesorios')}
            type="button">
            Accesorios
          </button>
          <button
            className="rounded-full bg-red-600 px-4 py-2 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800"
            type="button">
            Menor-Mayor
          </button>
        </div>
      </div>
    </div>
  )
}
