import React, { useState } from 'react'
import CalendarStep from './step1/components/CalendarStep'
import EquipmentStep from './step2/components/EquipmentStep'
import RegisterStep from './step3/components/RegisterStep'
import { FormContextProvider } from './context/FormContext'

export default function RentForm({ setBgStyle }) {
  const [currentStep, setCurrentStep] = useState(1)

  const steps = [
    <CalendarStep
      key="step1"
      onNext={() => setCurrentStep(2)}
      setBgStyle={setBgStyle}
    />,
    <EquipmentStep
      key="step2"
      onNext={() => setCurrentStep(3)}
      onBack={() => setCurrentStep(1)}
      setBgStyle={setBgStyle}
    />,
    <RegisterStep key="step3" onBack={() => setCurrentStep(2)} />,
  ]

  return (
    <div className="my-8 overflow-auto">
      <FormContextProvider>
        <div>{steps[currentStep - 1]}</div>
      </FormContextProvider>
    </div>
  )
}
