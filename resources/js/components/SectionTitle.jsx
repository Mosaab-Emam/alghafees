import React from "react";

const SectionTitle = ({
	isHeroSection = false,
	title,
	type,
	textColor = "text-primary-600",
}) => {
	return (
		<div className='flex items-center justify-start gap-2 '>
			{type === "tow-line_as_image" ? (
				<div className='line_as_image'></div>
			) : null}
			{isHeroSection ? (
				<p className='text-base font-normal text-Gray-scale-02 '>
					رحلتك العقارية في <span className=' text-primary-600'>جميع</span>{" "}
					انحاء المملكة
				</p>
			) : (
				<p className={`text-base font-normal ${textColor}`}>{title}</p>
			)}
			<div className='line_as_image'></div>
		</div>
	);
};

export default SectionTitle;
