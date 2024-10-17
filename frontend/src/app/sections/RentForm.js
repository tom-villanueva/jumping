import React from 'react'
import CalendarHome from './step1/components/CalendarHome'
import EquipmentSelection from './step2/components/EquipmentSelection'
import RegisterForm from './step3/components/RegisterForm'
import { useState } from 'react'

export default function RentForm({ setBgStyle }) {
  const [steps, setSteps] = useState(1)
  const [step1Range, setStep1] = useState(false)

  return (
    <div className="my-8 overflow-auto">
      <form>
        {steps === 1 ? (
          <CalendarHome
            setStep1={setStep1}
            setSteps={setSteps}
            setBgStyle={setBgStyle}
          />
        ) : steps === 2 ? (
          <EquipmentSelection
            range={step1Range}
            setSteps={setSteps}
            setBgStyle={setBgStyle}
          />
        ) : (
          <RegisterForm />
        )}
      </form>
    </div>
  )
}
