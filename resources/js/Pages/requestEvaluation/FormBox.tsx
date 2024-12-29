import React from "react";
import RequestEvaluationForm from "./requestEvaluationForm/RequestEvaluationForm";
import RequestEvaluationSteps from "./requestEvaluationSteps/RequestEvaluationSteps";

const FormBox = ({ step, onHandleNextStep, onHandlePrevStep }) => {
	return (
		<div className='xl:w-[1200px] lg:w-[1024px] w-[360px] md:h-[862px] h-auto flex md:flex-row flex-col md:items-start items-center md:gap-[35px] gap-8  glass-effect glass-effect-bg-primary-3 rounded-tl-[100px] rounded-br-[100px] md:p-[50px]  py-8 px-6'>
			<RequestEvaluationSteps step={step} />
			<RequestEvaluationForm
				step={step}
				onHandleNextStep={onHandleNextStep}
				onHandlePrevStep={onHandlePrevStep}
			/>
		</div>
	);
};

export default FormBox;
