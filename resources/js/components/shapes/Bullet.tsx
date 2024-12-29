import React from "react";

const Bullet = ({ blue, position }) => {
	return (
		<div
			className={`absolute z-[-1] ${position}  w-[30px] h-[30px] rounded-full flex justify-center items-center ${
				blue ? "bg-primary-600" : " bg-Gray-scale-03"
			}`}></div>
	);
};

export default Bullet;
