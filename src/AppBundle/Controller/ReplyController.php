<?php
/**
 * Created by PhpStorm.
 * User: arthurortin
 * Date: 23/09/2016
 * Time: 17:25
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Reply;
use AppBundle\Entity\Subject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/subjects")
 */

class ReplyController extends Controller  {

	/**
	 * @Route(path="/{id}/vote/replyUp", methods={"GET"}, name="reply_vote_up")
	 * @Template()
	 */
	public function replyUpvoteAction($id)
	{
		$reply = $this->getDoctrine()->getRepository(Reply::class)->find($id);
		$replyVote= $reply->getVote();
		$replyVote ++;
		$reply->setVote($replyVote);
		$this->getDoctrine()->getManager()->flush();

		return $this->redirectToRoute('subject_id', ['id' => $reply->getSubject()->getId()]);
	}

	/**
	 * @Route(path="/{id}/vote/replyDown", methods={"GET"}, name="reply_vote_down")
	 * @Template()
	 */
	public function replyDownvoteAction($id)
	{
		$reply = $this->getDoctrine()->getRepository(Reply::class)->find($id);
		$replyVote= $reply->getVote();
		$replyVote --;
		$reply->setVote($replyVote);
		$this->getDoctrine()->getManager()->flush();

		return $this->redirectToRoute('subject_id', ['id' => $reply->getSubject()->getId()]);
	}

}