import React from "react";

const BgGlassFilterShape = ({ position }) => {
	return (
		<div
			className={`w-[466px] h-full absolute ${position}`}
			style={{
				borderRadius: "286px",
				background:
					" radial-gradient(50% 50% at 50% 50%, rgba(15, 129, 159, 0.15) 0%, rgba(253, 255, 255, 0.00) 100%)",
			}}></div>
	);
};

export default BgGlassFilterShape;
