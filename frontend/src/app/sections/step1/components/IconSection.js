import React from 'react'
import { CreditCard, Bus, PersonStanding } from 'lucide-react'

export default function IconSection() {
  return (
    <div className="justify mt-16 flex flex-row items-start sm:gap-24">
      <div className="flex flex-col items-center justify-center gap-3">
        <CreditCard size={30} />
        <div>
          <p className="text-center font-montserrat text-sm font-light">
            Todos los
          </p>
          <p className="text-center font-montserrat text-sm font-light">
            medios de pago
          </p>
        </div>
      </div>
      <div className="flex flex-col items-center justify-center gap-3">
        <Bus size={30} />
        <p className="text-center font-montserrat text-sm font-light">
          Transporte
        </p>
      </div>
      <div className="flex flex-col items-center justify-center gap-3">
        <PersonStanding size={30} />
        <div>
          <p className="text-center font-montserrat text-sm font-light">
            Personaliza
          </p>
          <p className="text-center font-montserrat text-sm font-light">
            tu experiencia
          </p>
        </div>
      </div>
    </div>
  )
}
