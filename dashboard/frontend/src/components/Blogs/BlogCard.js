import { deleteBlog } from "api/blog";
import { useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { Button } from "reactstrap";
import { selectUser } from "redux/slices/userSlice";
import { formatDate } from "utils/commonFunctions";
import { useHistory } from "react-router";
import { updateBlog } from "api/blog";
import { Link } from "react-router-dom";

const BlogCard = ({ blogDetails }) => {
	const dispatch = useDispatch(),
		history = useHistory(),
		user = useSelector(selectUser);

	//eslint-disable-next-line
	const deleteHandler = async () => {
		const body = {
			userEmail: user?.email,
			blogId: blogDetails?.blogId,
		};
		const res = await dispatch(deleteBlog(body));
		if (res.status === "failed") alert("Failed to Delete");
	};

	async function publishHandler() {
		let data = {
			blogId: blogDetails?.blogId,
			blogTitle: blogDetails?.blogTitle,
			userEmail: blogDetails?.userEmail,
			userName: blogDetails?.userName,
			coverImage: blogDetails?.coverImage,
			content: blogDetails?.content,
			tags: blogDetails?.tags,
			approved: blogDetails?.approved,
			isPublished: blogDetails?.isDraft,
			isDraft: false,
		};
		let res;

		res = await updateBlog(data);
		if (res.status === "success") window.location.reload();
		if (res.status === "failed") {
			alert("Process Failed");
		}
	}
	
  async function unpublishHandler() {
		let data = {
			blogId: blogDetails?.blogId,
			blogTitle: blogDetails?.blogTitle,
			userEmail: blogDetails?.userEmail,
			userName: blogDetails?.userName,
			coverImage: blogDetails?.coverImage,
			content: blogDetails?.content,
			tags: blogDetails?.tags,
			approved: blogDetails?.approved,
			isPublished: blogDetails?.isDraft,
			isDraft: true,
		};

		let res;
		res = await updateBlog(data);
		if (res.status === "success") window.location.reload();
		if (res.status === "failed") {
			alert("Process Failed");
		}
	}

	return (
		<Link to={`/blog/${blogDetails?.blogId}`} className="contentBox">
			<div className="details">
				<h3>{blogDetails?.blogTitle}</h3>
				<p>{formatDate(blogDetails?.lastUpdated)}</p>
			</div>
			<div className="blog-buttons">
				{(!blogDetails?.approved && blogDetails?.isDraft) && (
					<Button
						color="info"
						className="bx bxs-pencil"
						onClick={() => history.push(`/createBlog/${blogDetails?.blogId}`)}
					/>
				)}
				{blogDetails?.isDraft && (
					<Button color="success" className="bx bx-cloud-upload" onClick={publishHandler} />
				)}
				{(blogDetails?.approved && !blogDetails?.isDraft) && (
					<Button color="danger" className="bx bx-cloud-download" onClick={unpublishHandler} />
				)}
			</div>
		</Link>
	);
};

export default BlogCard;
