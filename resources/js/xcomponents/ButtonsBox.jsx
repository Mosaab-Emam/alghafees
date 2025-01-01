import React from "react";
import Button from "./button/Button";

const ButtonsBox = ({
	icon,
	radius = "right",
	btnWidth = "sm:w-[140px] lg:w-[130px] xl:w-[150px]",
	outLinButtonOnClick,
	primaryButtonOnClick,
	flexDirection = "flex-row",
	gap = "sm:gap-8 lg:gap-2 xl:gap-4",
	primaryBtnContent,
	outlineBtnContent,
}) => {
	return (
		<div
			className={`w-full flex items-start  md:justify-end justify-center ${flexDirection} ${gap}`}>
			<Button
				onClick={outLinButtonOnClick}
				className={`sm:h-[48px] lg:h-[46px] xl:h-[48px] ${btnWidth}`}
				variant='out-line'>
				{outlineBtnContent}
			</Button>
			<Button
				onClick={primaryButtonOnClick}
				className={`sm:h-[48px] lg:h-[46px] xl:h-[48px] ${btnWidth}`}
				radius={radius}>
				{icon && <span className='w-5 h-5'>{icon}</span>}
				{primaryBtnContent}
			</Button>
		</div>
	);
};

export default ButtonsBox;
