import React from 'react'

export default function Order({ setSteps, setBgStyle }) {
  function handleSubmit() {
    setBgStyle(1)
    setSteps(3)
  }

  return (
    <div className="w-full">
      <p className="my-10 text-center font-montserrat text-xl font-bold uppercase text-black">
        Resumen de la reserva
      </p>
      <div className="w-full rounded-lg bg-zinc-900">
        <ul className="py-10">
          <li className="grid px-20 font-montserrat sm:grid-cols-5">
            <p className="font-medium">
              Item:<span className="font-normal"> Equipo completo x1/</span>
            </p>
            <p className="font-medium">
              Nivel:<span className="font-normal"> Principiante/</span>
            </p>
            <p className="font-medium">
              Altura:<span className="font-normal"> 172cm/</span>
            </p>
            <p className="font-medium">
              Talle:<span className="font-normal"> L</span>
            </p>
            <p className="font-bold text-red-600 sm:text-end">$15000</p>
          </li>
        </ul>
      </div>
      <div className="mt-10 flex w-full flex-col items-center justify-center sm:flex-row sm:justify-between">
        <div className="mb-10 flex flex-col items-center">
          <p className="font-montserrat font-bold text-black">SUBTOTAL:</p>
          <p className="font-montserrat font-bold text-red-600">$15000</p>
        </div>
        <button
          className="rounded-full bg-red-600 px-5 py-3 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800"
          onClick={() => handleSubmit()}>
          CONTINUAR
        </button>
      </div>
    </div>
  )
}
