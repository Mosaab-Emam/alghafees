import React from "react";
import { useState } from "react";
import { useEffect } from "react";

const ScrollProgress = () => {
	const [scrollProgress, setScrollProgress] = useState(0);

	useEffect(() => {
		const handleScroll = () => {
			const totalHeight =
				document.documentElement.scrollHeight - window.innerHeight;
			const progress = (window.scrollY / totalHeight) * 100;
			setScrollProgress(progress);
		};

		window.addEventListener("scroll", handleScroll);
		return () => window.removeEventListener("scroll", handleScroll);
	}, []);
	return (
		<div
			style={{
				position: "fixed",
				top: 0,
				right: 0,
				height: "5px",
				width: `${scrollProgress}%`,
				backgroundColor: "#0F819F",
				zIndex: 1000,
				transition: "width 0.5s linear",
				boxShadow: "0px 0px 35px 0px rgba(15, 129, 159, 0.16)",
			}}
		/>
	);
};

export default ScrollProgress;
