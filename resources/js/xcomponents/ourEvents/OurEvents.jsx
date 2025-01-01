import React from "react";
import { useNavigate } from "react-router-dom";

import TopSection from "./TopSection";
import Button from "../button/Button";

import EventsSection from "./eventsSection/EventsSection";
import "./OurEvents.css";
const OurEvents = () => {
	const navigate = useNavigate();

	return (
		<>
			<TopSection />
			<EventsSection />
			<Button
				onClick={() => navigate("/events")}
				className={
					"md:w-[300px] w-full py-[15px] px-[80px] bg-bg-01 text-primary-600 hover:text-bg-01 hover:bg-transparent  border border-bg-01 mx-auto"
				}>
				عرض الكل
			</Button>
		</>
	);
};

export default OurEvents;
