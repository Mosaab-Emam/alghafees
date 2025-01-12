import React, { Fragment } from "react";
import { requestEvaluationStepsData } from "../../../data/requestEvaluationStepsData";
import IsDoneICon from "./IsDoneICon";
import StepIcon from "./StepIcon";
import StepLineIcon from "./StepLineIcon";

const RequestEvaluationSteps = ({ step }) => {
	const updatedStepsData = requestEvaluationStepsData.map((item) => ({
		...item,
		isDone: step > item.id,
	}));

	return (
		<div
			className='inline-flex md:w-auto w-[300px]
  items-center gap-[10px] md:p-[50px] p-6 rounded-tl-[50px] rounded-br-[50px] border border-primary-600 bg-bg-01'>
			<div className='flex items-center gap-6'>
				<div className='w-[70px]  flex flex-col items-start gap-1'>
					{updatedStepsData.map((item, index) => (
						<Fragment key={item.id}>
							{item.isDone ? (
								<IsDoneICon />
							) : (
								<StepIcon step={step} item={item} />
							)}

							{index !== 4 && (
								<StepLineIcon
									index={index}
									step={step}
									item={item}
									isDone={item.isDone}
								/>
							)}
						</Fragment>
					))}
				</div>
				<div className='ms:w-[241px] w-full h-[661px] flex flex-col justify-between items-end'>
					{requestEvaluationStepsData.map((item) => (
						<div
							className='flex flex-col items-start self-stretch gap-1'
							key={item.id}>
							<div
								className={`${
									step >= item.id ? "text-primary-600" : "text-Gray-scale-01"
								} head-line-h3 text-right `}>
								0{item.id}
							</div>
							<p
								className={`${
									step >= item.id ? "text-Black-01" : "text-Gray-scale-01"
								} head-line-h4 text-right `}>
								{item.step}
							</p>
						</div>
					))}
				</div>
			</div>
		</div>
	);
};

export default RequestEvaluationSteps;
