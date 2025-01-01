import React from "react";
import { MarketAnalysisSVG } from "../../assets/icons";

const MarketAnalysisShape = ({ position }) => {
	return (
		<div className={`absolute ${position} `}>
			<MarketAnalysisSVG className='w-[208px] h-[208px] xl:w-[260px] lg:w-[200px] xl:h-[260px] lg:h-[200px] ' />
		</div>
	);
};

export default MarketAnalysisShape;
